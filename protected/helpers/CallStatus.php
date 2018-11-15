<?php

abstract class CallStatus
{
    const NotHandled=0;
    const Canceled = 1;
    const Rejected = 2;
    const Accepted= 3;
    const Running=4;
}