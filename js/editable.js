    <!-- Inline versus pop-up editing -->
    $.fn.editable.defaults.mode = 'inline';
   
    <!-- begin budget.php fields -->
    $('.name').editable({
    	name: 'name',
    });
    
    $('.category').editable({
    	name: 'category',
    });
    
    $('.tag').editable({
    	name: 'tag',
    });
    
    $('.amount').editable({
    	name: 'amount',
    });
    
    $('.note').editable({
    	name: 'note',
    });
    <!-- end budget -->
    <!-- begin overhead.php fields -->
    
    $('.budget_id').editable({
    	name: 'budget_id',
    });
    $('.percent_of_total').editable({
    	name: 'percent_of_total',
    });
    <!-- end overhead -->