<?php
namespace App\Helpers;
use App\Group;

class Helpers
{

    public static function _processTree($group, $parent, $utilities)
    {
        // var_dump("=======");
        // var_dump($group->id);
        // var_dump($group->name);
        // if($parent) {
        //     var_dump('parent:');
        //     var_dump($parent->id);
        // }
        $existingGroup = Group::find($group->id);
        
        if ($existingGroup) {
            
            // this node exists
            // update...
            $existingGroup->name = $group->name;
            $existingGroup->description = $group->description;

            // append node
            if ($parent) {
                $existingGroup->appendToNode($parent)->save(); 
            } else {
                $existingGroup->save();
            }
            $currentParent = $existingGroup;
            $utilities['seen'][] = $existingGroup->id;

            // remove from canBeDeleted if necessary
            if (in_array($existingGroup->id, $utilities['canBeDeleted'])) {
                unset($utilities['canBeDeleted'][array_search($existingGroup->id, $utilities['canBeDeleted'])]);
            }
        } else {
            // new node
            $newGroup = new Group;
            $newGroup->name = $group->name;
            $newGroup->description = $group->description;
            
            // append node
            if ($parent) {
                $newGroup->appendToNode($parent)->save();
            } else {
                $newGroup->save();
            }
            // var_dump('newGroupID:');
            // var_dump($newGroup->id);
            $currentParent = $newGroup;
            $utilities['seen'][] = $newGroup->id;
        }

        if (count($group->children) > 0) {
            // has children

            // get existing decendants and new descendants
            if ($existingGroup) {
                $existingDescendants = $existingGroup->children;
                $groupDescendants = $group->children;

                if (count($groupDescendants) > 0 && count($existingDescendants) > 0) {
                    $existingDescendantIds = $existingDescendants->pluck('id')->toArray();
                    // var_dump($existingDescendantIds);
                    $groupDescendantIds = array_column($groupDescendants, "id");
                    // var_dump($groupDescendantIds);
                    foreach($existingDescendantIds as $e_id) {

                        if (!in_array($e_id, $groupDescendantIds) && !in_array($e_id, $utilities['seen'])) {
                            $utilities['canBeDeleted'][] = $e_id;
                        }
                    }
                }
            }

            for ($i = 0; $i < count($group->children); $i++){
                $utilities = self::_processTree($group->children[$i], $currentParent, $utilities);
            }
        } else {
            // var_dump('else');
            // var_dump($existingGroup->id);
            if ($existingGroup) {
                $existingDescendants = $existingGroup->children;
                
                if (count($existingDescendants) > 0) {
                    $existingDescendantIds = $existingDescendants->pluck('id')->toArray();
                    // var_dump($existingDescendantIds);
                    foreach($existingDescendantIds as $e_id) {
                        if (!in_array($e_id, $utilities['seen'])) {
                            $utilities['canBeDeleted'][] = $e_id;
                        }
                    }
                    // var_dump($canBeDeleted);
                }
            }
        }
        // var_dump($canBeDeleted);
        return $utilities;
    }
}