<?php

namespace App\Permissions;

use App\Models\User;

final class Abilities
{
    // IpAddress abilities
    public const CreateIpAddress = 'create:ip_address';
    public const UpdateIpAddress = 'update:ip_address';
    public const DeleteIpAddress = 'delete:ip_address';
    public const ViewIpAddress = 'view:ip_address';

    // User abilities
    public const CreateUser = 'create:user';
    public const UpdateUser = 'update:user';
    public const DeleteUser = 'delete:user';

    public const ViewAuditLog = 'view:audit_log';

    /**
     * Abilities for the user based on their role
     *
     * @param \App\Models\User $user
     */
    public static function getAbilities(User $user): array
    {
        if ($user->is_admin === true) {
            return [
                self::CreateIpAddress,
                self::UpdateIpAddress,
                self::DeleteIpAddress,
                self::ViewIpAddress,

                self::CreateUser,
                self::UpdateUser,
                self::DeleteUser,

                self::ViewAuditLog
            ];
        } else {
            return [
                self::CreateIpAddress,
                self::UpdateIpAddress,
                self::ViewIpAddress,
            ];
        }
    }
}
