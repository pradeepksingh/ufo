
<table class="table table-striped table-bordered table-hover" style ="font-size:11px;width:75%;margin-left:25px;">
        <th>
        <td> Closed Entire day? </td>
        <td> Morning (Start Time)</td>      
        <td> Morning (End Time) </td>      
        <td> Evening (Start Time)</td>  
        <td> Evening (End Time)</td>
        </th>
         <tr>
        <td>Monday</td>         
        <td><input type="checkbox" name = "chkholiday1" id = "chkholiday1"   value = "1"/></td>
        <td> <input type="text" class="form-control resttime" id="mopen_time1" name="mopen_time1" value="<?php if(isset($timings)){echo date('h:i A',strtotime($timings[0]['morning_open_time']));}else{echo date('h:i A',strtotime('11:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="mclose_time1" name="mclose_time1" value="<?php if(isset($timings)) {echo date('h:i A',strtotime($timings[0]['morning_closing_time']));}else{echo date('h:i A',strtotime('15:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eopen_time1" name="eopen_time1" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[0]['evening_open_time']));}else{echo date('h:i A',strtotime('19:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eclose_time1" name="eclose_time1" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[0]['evening_closing_time']));}else{echo date('h:i A',strtotime('22:30:00'));}?>"/></td> 

        </tr>
       <tr>
        <td>Tuesday</td> 
      
       <td><input type="checkbox" name = "chkholiday2"  id = "chkholiday2" value = "1"/></td>
        <td> <input type="text" class="form-control resttime" id="mopen_time2" name="mopen_time2" value="<?php if(isset($timings)) {echo date('h:i A',strtotime($timings[1]['morning_open_time']));}else{echo date('h:i A',strtotime('11:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="mclose_time2" name="mclose_time2" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[1]['morning_closing_time']));}else{echo date('h:i A',strtotime('15:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eopen_time2" name="eopen_time2" value="<?php if(isset($timings)) { echo date('h:i A',strtotime($timings[1]['evening_open_time']));}else{echo date('h:i A',strtotime('19:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eclose_time2" name="eclose_time2" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[1]['evening_closing_time']));}else{echo date('h:i A',strtotime('22:30:00'));}?>"/></td> 
        </tr>
         <tr>
        <td>Wednesday</td> 
      
        <td><input type="checkbox" name = "chkholiday3"  id = "chkholiday3" value = "1"/></td>
        <td> <input type="text" class="form-control resttime" id="mopen_time3" name="mopen_time3" value="<?php  if(isset($timings)){ echo date('h:i A',strtotime($timings[2]['morning_open_time']));}else{echo date('h:i A',strtotime('11:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="mclose_time3" name="mclose_time3" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[2]['morning_closing_time']));}else{echo date('h:i A',strtotime('15:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eopen_time3" name="eopen_time3" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[2]['evening_open_time']));}else{echo date('h:i A',strtotime('19:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eclose_time3" name="eclose_time3" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[2]['evening_closing_time']));}else{echo date('h:i A',strtotime('22:30:00'));}?>"/></td> 

        </tr>
        <tr>
        <td>Thursday</td> 
       
        <td><input type="checkbox" name = "chkholiday4" id = "chkholiday4" value = "1"/></td>
        <td> <input type="text" class="form-control resttime" id="mopen_time4" name="mopen_time4" value="<?php if(isset($timings)) {echo date('h:i A',strtotime($timings[3]['morning_open_time']));}else{echo date('h:i A',strtotime('11:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="mclose_time4" name="mclose_time4" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[3]['morning_closing_time']));}else{echo date('h:i A',strtotime('15:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eopen_time4" name="eopen_time4" value="<?php if(isset($timings)) {echo date('h:i A',strtotime($timings[3]['evening_open_time']));}else{echo date('h:i A',strtotime('19:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eclose_time4" name="eclose_time4" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[3]['evening_closing_time']));}else{echo date('h:i A',strtotime('22:30:00'));}?>"/></td> 
        </tr>
         <tr>
        <td>Friday</td> 

       
        <td><input type="checkbox" name = "chkholiday5" id = "chkholiday5" value = "1"/></td>
        <td> <input type="text" class="form-control resttime" id="mopen_time5" name="mopen_time5" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[4]['morning_open_time']));}else{echo date('h:i A',strtotime('11:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="mclose_time5" name="mclose_time5" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[4]['morning_closing_time']));}else{echo date('h:i A',strtotime('15:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eopen_time5" name="eopen_time5" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[4]['evening_open_time']));}else{echo date('h:i A',strtotime('19:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eclose_time5" name="eclose_time5" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[4]['evening_closing_time']));}else{echo date('h:i A',strtotime('22:30:00'));}?>"/></td> 
        </tr>
          <tr>
        <td>Saturday</td> 
        
        <td><input type="checkbox" name = "chkholiday6" id = "chkholiday6" value = "1"/></td>
        <td> <input type="text" class="form-control resttime" id="mopen_time6" name="mopen_time6" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[5]['morning_open_time']));}else{echo date('h:i A',strtotime('11:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="mclose_time6" name="mclose_time6" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[5]['morning_closing_time']));}else{echo date('h:i A',strtotime('15:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eopen_time6" name="eopen_time6" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[5]['evening_open_time']));}else{echo date('h:i A',strtotime('19:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eclose_time6" name="eclose_time6" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[5]['evening_closing_time']));}else{echo date('h:i A',strtotime('22:30:00'));}?>"/></td> 

        </tr>
         <tr>
        <td>Sunday</td> 
        
        <td><input type="checkbox" name = "chkholiday7" id = "chkholiday7" value = "1"/></td>
        <td> <input type="text" class="form-control resttime" id="mopen_time7" name="mopen_time7" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[6]['morning_open_time']));}else{echo date('h:i A',strtotime('11:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="mclose_time7" name="mclose_time7" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[6]['morning_closing_time']));}else{echo date('h:i A',strtotime('15:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eopen_time7" name="eopen_time7" value="<?php if(isset($timings)) {echo date('h:i A',strtotime($timings[6]['evening_open_time']));}else{echo date('h:i A',strtotime('19:00:00'));}?>"/></td> 
        <td><input type="text" class="form-control resttime" id="eclose_time7" name="eclose_time7" value="<?php if(isset($timings)){ echo date('h:i A',strtotime($timings[6]['evening_closing_time']));}else{echo date('h:i A',strtotime('22:30:00'));}?>"/></td> 

        </tr>
        </table>
