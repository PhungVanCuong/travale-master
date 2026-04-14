<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactModel extends Model
{
    protected $table = 'tbl_contact';

    public function getContacts() {
        return DB::table($this->table)->where('isReply', 'n')->orderByDesc('contactId')->get();
    }

    public function updateContact($contactId, $data) {
        return DB::table($this->table)->where('contactId', $contactId)->update($data);
    }

    public function countContactsUnread() {
        $contacts = $this->getContacts();
        return [
            'countUnread' => $contacts->count(),
            'contacts' => $contacts
        ];
    }
}
