<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class ChatController extends Controller
{

    public function index()
    {
        $database = app('firebase.firestore');
        $chats =  $database->database()->collection('chat')->documents();
        $doctors =  $database->database()->collection('Doctors')->documents();
        $clients =  $database->database()->collection('clients')->documents();

        $chats_list = array();
        $doctors_list = array();
        $clients_list = array();

        foreach ($chats as $chat) {
            if ($chat->exists()) {
                array_push($chats_list, $chat->data());
            }
        }

        foreach ($doctors as $key=> $doctor) {
            if ($doctor->exists()) {
                array_push($doctors_list, $doctor->data());
                $doctors_list[$key]['id'] = $doctor->id();
            }
        }

        foreach ($clients as $key=> $client) {
            if ($client->exists()) {
                array_push($clients_list, $client->data());
                $clients_list[$key]['id'] = $client->id();
            }
        }

        $conversations = array();
        $participants = (object) array();

        if(request()->has('doctor') && request()->has('client')) {
            if(!is_null(request()->get('doctor')) && !is_null(request()->get('client'))) {
                foreach($doctors_list as $key=>$doctor){
                    if($doctor['id'] == request()->get('doctor')) {
                        $doctorName = $doctor['name'];
                        $doctorID = $doctor['id'];
                    }
                }

                foreach($clients_list as $key=>$client){
                    if($client['id'] == request()->get('client')) {
                        $clientName = $client['name'];
                        $clientID = $client['id'];
                    }
                }

                $participants = (object) array(
                    "client" =>  $clientID,
                    "clientName" => $clientName,
                    "doctor" =>  $doctorID,
                    "doctorName" => $doctorName
                );

                usort($chats_list, function($a, $b){
                    return $a['timestamp'] <=> $b['timestamp'];
                });

                foreach($chats_list as $key=>$chat){
                    if(!empty($chat['message']) && ($chat['senderID'] == request()->get('doctor') 
                            || $chat['receiverID'] == request()->get('doctor'))
                            && ($chat['senderID'] == request()->get('client') 
                            || $chat['receiverID'] == request()->get('client'))) {
                        array_push($conversations, array(
                            "senderName" => ($chat['senderID'] == $clientID) ? $clientName : $doctorName,
                            "receiverName" => ($chat['receiverID'] == $clientID) ? $clientName : $doctorName,
                            "senderID" => $chat['senderID'],
                            "receiverID" => $chat['receiverID'],
                            "client" =>  $clientID,
                            "clientName" => $clientName,
                            "doctor" =>  $doctorID,
                            "doctorName" => $doctorName,
                            "image_message" => $chat['image_message'],
                            "message" => $chat['message'],
                            "timestamp" => date('H:i A, d F Y', strtotime($chat['timestamp'])),
                            "is_received" => $chat['is_received']
                        ));
                    } 
                }
            }
        }
        
        return view('pages.chats.index', compact('doctors_list','clients_list','conversations','participants'));
    }
}
