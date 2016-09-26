<?php

namespace Admin\Model;

use Think\Model\ViewModel;

class ActmessageViewModel extends ViewModel {

    protected $viewFields = array(
        'td_actmessage' => array('act_name'),
        'td_students' => array('name', '_on' => 'td_actmessage.act_id = td_students.act_id'),
    );

}
