<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AutocompleteController extends Controller
{
    function fetch($id)
    {
        
      $data = DB::table('categories')->where('parent_id',$id)->get();
    if(count($data)>0){
      
     
      foreach($data as $row)
      {
      $output ="<a href='/category/$row->slug'><div class='sidenavContent'>";
      $output .= $row->name;
      $output .="</div></a>";

      echo $output;
      }     
    }
   
    else{
        echo "<div>
    <div>";
                     echo "<tr><td style='width: 365px;'> <a> Not found ... </a> </td></tr>";
echo "    </div>
</div>";
   
    }
}

    
}
