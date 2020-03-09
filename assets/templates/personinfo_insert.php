<div class="form-wraper">
    <h2> <?php _e( "Add Persons Information",'sa-crud' ); ?></h2>
    <div class="form-content">
        <form name="person-form" id="person-form">


            <label for="name"><strong>Name</strong> </label>

            <input type="text" name="name" id="name" value="" placeholder="Enter your name....">
            <div class="sacrud-name-msg"></div>
            <label for="email"><strong>Email</strong> </label>
            <input type="text" name="email" id="email" value="" placeholder="Enter your email....">
            <div class="sacrud-email-msg"></div>
            <label for="age"><strong>Age</strong></label>
            <input type="text" name="age" id="age" value="" placeholder="Enter your age....">
            <div class="sacrud-age-msg"></div>
            <?php 
            
                submit_button( "Add Person Info" );
            
             ?>
            <div class="sacrud-message"></div>
        </form>

    </div>
</div>
