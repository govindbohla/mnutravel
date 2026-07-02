<?php

namespace App\Services;

use App\Models\ContactDetail;

class ContactDetailService
{
    public function current(): ContactDetail
    {
        return ContactDetail::query()->firstOrCreate(['id' => 1]);
    }

    public function update(array $data): ContactDetail
    {
        $contactDetail = $this->current();

        $contactDetail->update($data);

        return $contactDetail->fresh();
    }
}
