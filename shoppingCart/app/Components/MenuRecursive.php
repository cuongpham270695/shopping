<?php


namespace App\Components;


use App\Models\Menu;

class MenuRecursive
{
    private $html;
    public function __construct()
    {
        $this->html = '';
    }

    public function menuRecursiveCreate($parentId = 0, $subMark = ''): string
    {
        $data = Menu::where('parent_id',$parentId)->get();
        foreach ($data as $dataItem)
        {
            $this->html .= "<option value='$dataItem->id'>". $subMark . $dataItem->name . "</option>>";
            $this->menuRecursiveCreate($dataItem->id,$subMark . '-');
        }
        return $this->html;
    }

    public function menuRecursiveEdit($parent_id_edit,$parentId = 0, $subMark = ''): string
    {
        $data = Menu::where('parent_id',$parentId)->get();
        foreach ($data as $dataItem)
        {
            if ($parent_id_edit == $dataItem->id) {
                $this->html .= "<option selected value='$dataItem->id'>". $subMark . $dataItem->name . "</option>>";
            } else {
                $this->html .= "<option value='$dataItem->id'>". $subMark . $dataItem->name . "</option>>";
            }
            $this->menuRecursiveEdit($parent_id_edit,$dataItem->id,$subMark . '-');
        }
        return $this->html;
    }
}
