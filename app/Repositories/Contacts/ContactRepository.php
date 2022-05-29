<?php

namespace App\Repositories\Contacts;

use App\Models\Contacts\Contact;
use App\Repositories\BaseRepository;
use App\Traits\CreateUpdateByTrait\CreateUpdateByTrait;


//use Your Model

/**
 * Class ContactRepository.
 */
class ContactRepository extends BaseRepository
{

    use CreateUpdateByTrait;
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    protected $fieldSearchable = [
        'ref_id',
        'ref_resource',
        'account_id',
        'type',
        'user_id',
        'salutation',
        'first_name',
        'last_name',
        'email',
        'phone',
        'phone_2',
        'phone_3',
        'phone_4',
        'street_no',
        'house_no',
        'address',
        'zip_postalcode',
        'latitude',
        'longitude',
        'profile',
        'date_of_birth',
        'remark',
        'created_by',
        'updated_by'
    ];
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Contact::class;
    }

    public function createContact($user, $request){
        Contact::updateOrCreate(
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                // 'account_id' => $request->account_id,
                'email' => $user->email,
            ]
        );
    }
    public function updateContact($entry, $request)
    {
        Contact::updateOrCreate(
            [
                'user_id' => $entry->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                // 'account_id' => $request->account_id,
                'email' => $entry->email,
            ]
        );
    }

}
