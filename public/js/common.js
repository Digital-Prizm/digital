 /**
     * Initializing date field using pickaday plugin
     *
     * @return string
     */
function initDOBDatepicker() {

    window.setTimeout( function() {
        var picker = new Pikaday({
            field: document.getElementById('dob'),
            format: 'YYYY-M-D',
            toString(date, format) {
            var  day = date.getDate();
            var  month = date.getMonth() + 1;
            const year = date.getFullYear();
        
            if(day<10)
            day ='0'+ day;
            
            if(month<10)
            month ='0'+month;

            return `${year}-${month}-${day}`;
            },
            onSelect: function() {
                console.log("sending event...");
                window.livewire.emit('listener_calculateAssumedDate');
               //console.log(this.getMoment().format('Do MMMM YYYY'));
            }
        });

},2000);

}


 /**
     * Initializing expiry date field using pickaday plugin
     *
     * @return string
     */
    function initExpiryDateDatepicker() {

        window.setTimeout( function() {
            var picker = new Pikaday({
                field: document.getElementById('expiry_date'),
                format: 'YYYY-M-D',
                toString(date, format) {
                var  day = date.getDate();
                var  month = date.getMonth() + 1;
                const year = date.getFullYear();
            
                if(day<10)
                day ='0'+ day;
                
                if(month<10)
                month ='0'+month;
    
                return `${year}-${month}-${day}`;
                },
                onSelect: function() {
                   // console.log("sending event...");
                   
                }
            });
    
    },2000);
    
    }


     /**
     * Initializing expiry before date field using pickaday plugin
     *
     * @return string
     */
    function initExpiryBeforeDateDatepicker() {

        window.setTimeout( function() {
            var picker = new Pikaday({
                field: document.getElementById('expiry_before_date'),
                format: 'YYYY-M-D',
                toString(date, format) {
                var  day = date.getDate();
                var  month = date.getMonth() + 1;
                const year = date.getFullYear();
            
                if(day<10)
                day ='0'+ day;
                
                if(month<10)
                month ='0'+month;
    
                return `${year}-${month}-${day}`;
                },
                onSelect: function() {
                   // console.log("sending event...");
                   
                }
            });
    
    },2000);
    
    }

