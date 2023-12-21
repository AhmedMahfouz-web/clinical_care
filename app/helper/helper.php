<?php

function check_uuid($model, $uuid)
{
    if ($model::find($uuid) != null) {
        check_uuid($model, $uuid);
    }

    return $uuid;
}
