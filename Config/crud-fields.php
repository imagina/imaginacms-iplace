<?php

return [
  'places' => [
    'whatsapp1CallingCode' => [
      'name' => 'whatsapp1CallingCode',
      'value' => null,
      'type' => 'select',
      'columns' => 'col-6 col-xl-2 q-pr-sm q-pt-sm',
      'fakeFieldName' => 'options',
      'isFakeField' => true,
      'props' => [
        'label' => 'icustom::common.iplace.whatsapp1.code',
      ],
      'loadOptions' => [
        'apiRoute' => 'apiRoutes.qlocations.countries', //apiRoute to request
        'select' => ['label' => 'name', 'id' => 'callingCode'], //Define fields to config select
      ],
    ],
    'whatsapp1Number' => [
      'name' => 'whatsapp1Number',
      'value' => null,
      'type' => 'input',
      'columns' => 'col-6 col-xl-2 q-pr-sm q-pt-sm',
      'fakeFieldName' => 'options',
      'isFakeField' => true,
      'props' => [
        'label' => 'icustom::common.iplace.whatsapp1.number',
        'type' => 'number',
      ]
    ],
    'whatsapp1Message' => [
      'name' => 'whatsapp1Message',
      'value' => null,
      'type' => 'input',
      'columns' => 'col-12 col-xl-3 q-pr-sm q-pt-sm',
      'fakeFieldName' => 'options',
      'isFakeField' => true,
      'props' => [
        'label' => 'icustom::common.iplace.whatsapp1.message',
      ]
    ],
    'whatsapp2CallingCode' => [
      'name' => 'whatsapp2CallingCode',
      'value' => null,
      'type' => 'select',
      'columns' => 'col-6 col-xl-2 q-pr-sm q-pt-sm',
      'fakeFieldName' => 'options',
      'isFakeField' => true,
      'props' => [
        'label' => 'icustom::common.iplace.whatsapp2.code',
      ],
      'loadOptions' => [
        'apiRoute' => 'apiRoutes.qlocations.countries', //apiRoute to request
        'select' => ['label' => 'name', 'id' => 'callingCode'], //Define fields to config select
      ],
    ],
    'whatsapp2Number' => [
      'name' => 'whatsapp2Number',
      'value' => null,
      'type' => 'input',
      'columns' => 'col-6 col-xl-2 q-pr-sm q-pt-sm',
      'fakeFieldName' => 'options',
      'isFakeField' => true,
      'props' => [
        'label' => 'icustom::common.iplace.whatsapp2.number',
        'type' => 'number',
      ]
    ],
    'whatsapp2Message' => [
      'name' => 'whatsapp1Message',
      'value' => null,
      'type' => 'input',
      'columns' => 'col-12 col-xl-3 q-pr-sm q-pt-sm',
      'fakeFieldName' => 'options',
      'isFakeField' => true,
      'props' => [
        'label' => 'icustom::common.iplace.whatsapp2.message',
      ]
    ],
    'addressIplace' => [
      'name' => 'addressIplace',
      'value' => null,
      'type' => 'input',
      'props' => [
        'label' => 'icustom::common.iplace.address',
        'type' => 'text'
      ],
    ],
  ]
];
