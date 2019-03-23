<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface DropDatabase extends DDLStatement, Name, IfExists
{
}
