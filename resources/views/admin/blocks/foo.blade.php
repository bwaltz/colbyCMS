@formField('wysiwyg', [
    'name' => 'content',
    'label' => 'Text',
    'placeholder' => 'Text',
    'toolbarOptions' => [
        'bold',
        'italic',
        ['list' => 'bullet'],
        ['list' => 'ordered'],
        [ 'script' => 'super' ],
        [ 'script' => 'sub' ],
        'link',
        'clean'
    ],
])
