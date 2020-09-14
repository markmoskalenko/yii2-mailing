<?php

namespace markmoskalenko\mailing\common\interfaces;

interface BroadcastServiceInterface
{
    /**
     * @param string $channel
     * @param array $data
     * @param Boolean $isSendNow
     * @return mixed
     */
    public function dispatch($channel, $data, $isSendNow, $userId);
}
