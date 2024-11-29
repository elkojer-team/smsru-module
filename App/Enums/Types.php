<?php
namespace Modules\SMSRU\App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;
final class Types extends Enum
{
    #[Description("Сообщения")]
    const SMS = 'sms';
    #[Description("Звонки")]
    const CALL = 'call';

}
