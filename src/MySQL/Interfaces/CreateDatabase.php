<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateDatabase extends DDLStatement, Name, IfNotExists, Charset, Collation
{
}
