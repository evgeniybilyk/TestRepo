<?php

    /**
	 * Обьект класса для работы с шаблонизатором
	 */
	$GLOBAL_TEMPLATE = new Template();

    /**
     * Обьект класса для работы с базой данных
     */
    $GLOBAL_DATABASE = Database::getInstance();
    $GLOBAL_DATABASE->connect(
        DATABASE_HOST,
        DATABASE_USERNAME,
        DATABASE_PASSWORD,
        DATABASE_BASENAME
    );