<div class="form-wraper">
    <h2> <?php _e( "Add Persons Information",'sa-crud' ); ?></h2>
    <div class="form-content">
        <form name="person-form-upd" id="person-form-upd">

            <label for="name"><strong>Name</strong> </label>

            <input type="text" name="name" id="name" value="<?php if($id){ echo $result->name;} ?>">
            <div class="sacrud-name-msg"></div>
            <label for="email"><strong>Email</strong> </label>
            <input type="text" name="email" id="email" value="<?php if($id){ echo $result->email;} ?>">
            <div class="sacrud-email-msg"></div>
            <label for="age"><strong>Age</strong> </label>
            <input type="text" name="age" id="age" value="<?php if($id){ echo $result->age;} ?>">
            <div class="sacrud-age-msg"></div>
            <?php 
                echo '<input type="hidden" name="id" value="' . $id . '">';
                submit_button( "Update Info" );
             ?>
            <div class="sacrud-message"></div>
        </form>

    </div>
</div>
