<?php

namespace Modules\Enums;

use Modules\Models\Book;

enum ECategorable:string
{
    use EnumHelper;

    case Book = Book::class;
}
