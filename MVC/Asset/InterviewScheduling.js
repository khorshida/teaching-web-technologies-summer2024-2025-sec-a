function submitAvailability() {
            let selectedTime = document.getElementById("timeSelector").value;

            let errorField = document.getElementById("timeError");

             errorField.innerHTML = "";
            
            // Validation logic
    if(selectedTime === "" || selectedTime === "-- Select a time --") {
        errorField.innerHTML = "Please select a time slot.";
        return false; 
    }
            
           
           return true; 
        }

     
