<?php

if($d->status == 'payment')
{
    return '<a href="'.routeTo('transactions/confirm',['id'=>$d->id]).'" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Konfirmasi Pembayaran</a>';
}

return '';