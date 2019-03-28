<?php

namespace DBClass\MySQL\Interfaces;

interface DropDatabase extends DDLStatement, Name, IfExists
{
}
