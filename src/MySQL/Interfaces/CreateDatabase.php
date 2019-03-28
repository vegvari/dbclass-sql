<?php

namespace DBClass\MySQL\Interfaces;

interface CreateDatabase extends DDLStatement, Name, IfNotExists, Charset, Collation
{
}
