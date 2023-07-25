<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionSet extends Model
{

    public const PERMISSIONS_LABEL  = "permissions";

    //Stations
    public const PERMISSION_DOCTOR_ADD        = "PERMISSION_DOCTOR_ADD";
    public const PERMISSION_DOCTOR_EDIT       = "PERMISSION_DOCTOR_EDIT";
    public const PERMISSION_DOCTORS_VIEW      = "PERMISSION_DOCTORS_VIEW";
    public const PERMISSION_DOCTOR_DELETE    = "PERMISSION_DOCTOR_DELETE";

    //Users
    public const PERMISSION_USER_ADD    = "PERMISSION_USER_ADD";
    public const PERMISSION_USER_EDIT   = "PERMISSION_USER_EDIT";
    public const PERMISSION_USERS_VIEW  = "PERMISSION_USERS_VIEW";
    public const PERMISSION_USER_DELETE = "PERMISSION_USER_DELETES";

    //Videos
    public const PERMISSION_VIDEO_ADD         = "PERMISSION_VIDEO_ADD";
    public const PERMISSION_VIDEO_EDIT        = "PERMISSION_VIDEO_EDIT";
    public const PERMISSION_VIDEOS_VIEW       = "PERMISSION_VIDEOS_VIEW";
    public const PERMISSION_VIDEO_DELETE      = "PERMISSION_VIDEO_DELETES";

    //Roles
    public const PERMISSION_ROLE_ADD    = "PERMISSION_ROLE_ADD";
    public const PERMISSION_ROLE_EDIT   = "PERMISSION_ROLE_EDIT";
    public const PERMISSION_ROLES_VIEW  = "PERMISSION_ROLES_VIEW";
    public const PERMISSION_ROLE_DELETE = "PERMISSION_ROLE_DELETE";

    //Subscriptions
    public const PERMISSION_SUBSCRIPTION_ADD    = "PERMISSION_SUBSCRIPTION_ADD";
    public const PERMISSION_SUBSCRIPTION_EDIT   = "PERMISSION_SUBSCRIPTION_EDIT";
    public const PERMISSION_SUBSCRIPTIONS_VIEW  = "PERMISSION_SUBSCRIPTIONS_VIEW";
    public const PERMISSION_SUBSCRIPTION_DELETE = "PERMISSION_SUBSCRIPTION_DELETE";

    //Reports
    public const PERMISSION_REPORT_ADD     = "PERMISSION_REPORT_ADD";
    public const PERMISSION_REPORT_EDIT    = "PERMISSION_REPORT_EDIT";
    public const PERMISSION_REPORTS_VIEW   = "PERMISSION_REPORTS_VIEW";
    public const PERMISSION_REPORT_DELETE  = "PERMISSION_REPORT_DELETE";

    //Video Categories
    public const PERMISSION_CATEGORY_ADD     = "PERMISSION_CATEGORY_ADD";
    public const PERMISSION_CATEGORY_EDIT    = "PERMISSION_CATEGORY_EDIT";
    public const PERMISSION_CATEGORIES_VIEW   = "PERMISSION_CATEGORIES_VIEW";
    public const PERMISSION_CATEGORY_DELETE  = "PERMISSION_CATEGORY_DELETE";

    //Doctor Categories
    public const PERMISSION_DOCTOR_CATEGORY_ADD     = "PERMISSION_DOCTOR_CATEGORY_ADD";
    public const PERMISSION_DOCTOR_CATEGORY_EDIT    = "PERMISSION_DOCTOR_CATEGORY_EDIT";
    public const PERMISSION_DOCTOR_CATEGORIES_VIEW   = "PERMISSION_DOCTOR_CATEGORIES_VIEW";
    public const PERMISSION_DOCTOR_CATEGORY_DELETE  = "PERMISSION_DOCTOR_CATEGORY_DELETE";

    //Video Comments
    public const PERMISSION_COMMENT_ADD     = "PERMISSION_COMMENT_ADD";
    public const PERMISSION_COMMENT_EDIT    = "PERMISSION_COMMENT_EDIT";
    public const PERMISSION_COMMENTS_VIEW   = "PERMISSION_COMMENTS_VIEW";
    public const PERMISSION_COMMENT_DELETE  = "PERMISSION_COMMENT_DELETE";

    //Chats
    public const PERMISSION_CHAT_ADD     = "PERMISSION_CHAT_ADD";
    public const PERMISSION_CHAT_EDIT    = "PERMISSION_CHAT_EDIT";
    public const PERMISSION_CHATS_VIEW   = "PERMISSION_CHATS_VIEW";
    public const PERMISSION_CHAT_DELETE  = "PERMISSION_CHAT_DELETE";

    //Banners
    public const PERMISSION_BANNER_ADD     = "PERMISSION_BANNER_ADD";
    public const PERMISSION_BANNER_EDIT    = "PERMISSION_BANNER_EDIT";
    public const PERMISSION_BANNERS_VIEW   = "PERMISSION_BANNERS_VIEW";
    public const PERMISSION_BANNER_DELETE  = "PERMISSION_BANNER_DELETE";

    //Transactions
    public const PERMISSION_TRANSACTION_ADD     = "PERMISSION_TRANSACTION_ADD";
    public const PERMISSION_TRANSACTION_EDIT    = "PERMISSION_TRANSACTION_EDIT";
    public const PERMISSION_TRANSACTIONS_VIEW   = "PERMISSION_TRANSACTIONS_VIEW";
    public const PERMISSION_TRANSACTION_DELETE  = "PERMISSION_TRANSACTION_DELETE";


    public static function permissions() {
        $refClass = new \ReflectionClass(static::class);
        $constantList =  $refClass->getConstants();
        $permissions = [];
        foreach ($constantList as  $key => $item) {
            if (str_contains($key, 'PERMISSION_')){
                $permissions[$key] = $item;
            }
        }
        return $permissions;
    }

    public static function permissionsGroups() {
        $refClass = new \ReflectionClass(static::class);
        $constantList =  $refClass->getConstants();
        $permissions = [];
        foreach ($constantList as  $key => $item) {
            if (str_contains($key, 'PERMISSION_')){
                $perms = explode('_', $key);
                $group = $perms[1];
                if (!isset($permissions[$group])) {
                    $permissions[$group] = [
                        'name' => $group,
                        self::PERMISSIONS_LABEL => []
                    ];
                }
                $permissions[$group][self::PERMISSIONS_LABEL][] = $item;
            }
        }
        return $permissions;
    }
}
