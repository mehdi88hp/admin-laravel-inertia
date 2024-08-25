<?php

namespace Modules\Enums;

use Modules\Models\Book;

enum EGenreable:string
{
    use EnumHelper;

    case Book = Book::class;
}
