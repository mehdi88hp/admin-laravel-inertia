<?php

namespace Modules\Enums;

enum EWordType:int
{
    use EnumHelper;

    case Unknown = 0;
    case Noun = 1;
    case Adjective = 2;
}
