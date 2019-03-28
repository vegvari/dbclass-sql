<?php

namespace DBClass\MySQL\Interfaces;

interface DropTable extends DDLStatement, Name, IfExists
{
}
