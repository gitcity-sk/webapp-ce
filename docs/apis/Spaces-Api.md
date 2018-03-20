# Spaces Api

Using `namespace App\Http\Controllers\Spaces\Api` namespace

Current Version: **1.0**

## Getting files

To show all files in current space path

```
GET /spaces/{space}/files/{path?}
```

## Getting folders

To show folders in current path

```
GET /spaces/{space}/directories/{path?}
```

## Getting Spaces size

To show current space space size

```
GET /spaces/{space}/size
```

## Getting folder size

To show size of current path (for all files and folders included)

```
GET /spaces/size-of/{path?}
```

## Filtering files by types [Not implemented yet]

Return files on  `type`  from given path. For type use file extension which you want get.

```
GET /spaces/{space}/files/{path?}?type={type}
```