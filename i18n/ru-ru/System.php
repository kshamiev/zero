<?php
/**
 * File Language
 *
 * model =
 * model prop Status =
 * model prop Status validate key1 =
 * model prop Status validate key2 =
 * model prop Status option cold =
 * model prop Status option hot =
 *
 * controller Zero_Users_Grid =
 * controller Zero_Users_Grid action name1 =
 * controller Zero_Users_Grid action name2 =
 * controller Zero_Users_Grid message name1 =
 * controller Zero_Users_Grid message name2 =
 *
 * 'translation Key' => 'Translation Value'
 */
return [
    'model' => [
        'Property all' => 'Все свойства',

    ],
    'view' => [
        'engine' => 'Инженеринг',
        'model factory' => 'Создание моделей',
        'controller Zero_System_GridService action Cache_Reset' => 'Сброс всего кеша',
        'controller Zero_System_GridService action Session_Reset' => 'Сброс всех сессий',
    ],
    'controller' => [
        'Action_FolderGo' => 'переход по папкам',
        'Action_FolderRemove' => 'удаление папки',
        'Action_FileRemove' => 'удаление файла',
        'Action_FileDownLoad' => 'отдача файла пользователю',
        'Action_FileUpload' => 'загрузка файла на сервер',
        'Action_FolderAdd' => 'создание папки',
        'Action_EditFile' => 'изменение файла',
        'Action_FileSave' => 'сохранение файла',
        'Action_EngineModulesDB' => 'инженеринг моделей',
        'Action_CacheReset' => 'полный сброс кеша',
        'Action_SessionReset' => 'сброс всех сессий',
    ],
];
return [
    'controller Zero_System_GridService' => 'Разработка и обслуживание системы',
    'controller Zero_System_GridService action Default' => 'контроллер по умолчанию',
    'controller Zero_System_GridService action EngineModulesDB' => 'Инженеринг моделей',
    'controller Zero_System_GridService action CacheReset' => 'полный сброс кеша',
    'controller Zero_System_GridService action SessionReset' => 'сброс всех сессий',
    'controller Zero_System_GridService action Cache_Reset' => 'полный сброс кеша',
    'controller Zero_System_GridService action Session_Reset' => 'сброс всех сессий',
    'controller Zero_System_GridService message Session_Reset' => 'Сессии сброшены',
    'controller Zero_System_GridService message Cache_Reset' => 'Кеш сброшен',
    'controller Zero_System_GridService message Engine_Modules_DB' => 'Модуль создан и/или проинициализирован',
    'controller Zero_System_GridService message Error_Engine_Modules_DB' => 'Ошибка создания модуля',
    'controller Zero_System_GridService message Error_NotParam' => 'Параметры запроса не заданы',
    'controller Zero_System_FileEdit' => 'Файловый менеджер',
    'controller Zero_System_FileEdit action FileSave' => 'сохранить',
    'controller Zero_System_FileEdit message FileSave' => 'Файл сохранен',
    'controller Zero_System_FileManager' => 'Файловый менеджер',
    'controller Zero_System_FileManager action FolderGo' => 'переход по папкам',
    'controller Zero_System_FileManager action FolderRemove' => '',
    'controller Zero_System_FileManager action FileRemove' => 'удаление файла',
    'controller Zero_System_FileManager action FileDownLoad' => 'отдача файла пользователю',
    'controller Zero_System_FileManager action FileUpload' => 'загрузка файла на сервер',
    'controller Zero_System_FileManager action FolderAdd' => 'создание папки',
    'controller Zero_System_FileManager action EditFile' => 'изменение файла',
    'controller Zero_System_FileManager action Default' => 'контроллер по умолчанию',
    'controller Zero_System_FileManager message FolderAdd' => 'Папка создана',
    'controller Zero_System_FileManager message Error_FolderAdd' => 'Ошибка создания папки',
    'controller Zero_System_FileManager message FileUpload' => 'Файл загружен',
    'controller Zero_System_FileManager message Error_FileUpload' => 'Ошибка загрузки файла',
    'controller Zero_System_FileManager message FileRemove' => 'Файл удален',
    'controller Zero_System_FileManager message Error_FileRemove' => 'Ошибка удаления файла',
    'controller Zero_System_FileManager message FolderRemove' => 'Папка удалена',
    'controller Zero_System_FileManager message Error_FolderRemove' => 'Ошибка удаления папки',
    'controller Zero_System_GridModules' => 'Управление модулями',
    'controller Zero_System_GridModules action Up' => 'обновление модуля',
    'controller Zero_System_GridModules action Set' => 'установка модуля',
    'controller Zero_System_GridModules action Rem' => 'удаление модуля',
    'controller Zero_System_GridModules message Rem' => 'Модуль удален',
    'controller Zero_System_GridModules message Failure to remove the module from the database' => 'Ошибка удаления модуля из БД',
    'controller Zero_System_GridModules message Error installing the module in the database' => 'Ошибка установки модуля в БД',
    'controller Zero_System_GridModules message Module already installed' => 'Модуль уже установлен или не требует инсталяции',
    'controller Zero_System_GridModules message Module already removed' => 'Модуль уже удален или не требует удаления',
    'controller Zero_System_GridModules message Application installed' => 'Приложение установлено',
    'controller Zero_System_GridModules message Application removed' => 'Приложение удалено',
    'controller Zero_System_GridModules message Module installed' => 'Модуль установлен',
    'controller Zero_System_GridModules message Module removed' => 'Модуль удален',
    'controller Zero_System_GridModules message Installer Not Found' => 'Инсталятор не найден',
    'controller Zero_System_GridModules message DeInstaller Not Found' => 'Деинсталятор не найден',
    'translation engine' => 'Инженеринг моделей',
    'translation model factory' => 'Факторинг/Рефакторинг моделей.<br>Если модель отсутсвует она создается.<br>Указывается имя модуля (ориентация по БД).<br>',
    'translation Key' => 'Translation Value',
];