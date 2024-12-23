(function($){
$(function(){
	/*
		TIMED WORKOUT
	*/
	$(document).ready(function() {
	    let blockIndex = 0;
	    let blockDuration = 3 * 60; // 3 minutes in seconds
	    let breakDuration = 1 * 60; // 1 minute in seconds
	    let interval;
	    
	    // Function to update the UI for the timer text and progress bar
	    function updateTimer(duration, totalDuration) {
	        let minutes = Math.floor(duration / 60);
	        let seconds = duration % 60;
	        seconds = seconds < 10 ? '0' + seconds : seconds;
	        $('#ui-timer-txt').text(`${minutes}:${seconds}`);
	        
	        // Update progress bar
	        let progress = (1 - (duration / totalDuration)) * 100;
	        $('#ui-timer-bar').css('width', progress + '%');
	    }
	
	    // Function to show a block or break
	    function showBlock() {
	        clearInterval(interval); // Clear any previous intervals
	
	        if (blockIndex < $('.block').length) {
	            $('.block, .break').hide(); // Hide all blocks and breaks
	
	            // Show current block
	            $('.block').eq(blockIndex).show();
	            // change progress bar color
				$('#ui-timer-bar').css('background', '#ff6c3b');
	
	            let remainingTime = blockDuration;
	
	            interval = setInterval(function() {
	                updateTimer(remainingTime, blockDuration);
	                remainingTime--;
	
	                if (remainingTime < 0) {
	                    clearInterval(interval);
	                    showBreak(); // After the block, show the break
	                }
	            }, 1000);
	        }
	    }
	
	    // Function to show the break
	    function showBreak() {
	        $('.block, .break').hide(); // Hide all blocks and breaks
	        $('.break').show(); // Show break
			$('#ui-timer-bar').css('background', '#0f7d7c');
	        let remainingTime = breakDuration;
	
	        interval = setInterval(function() {
	            updateTimer(remainingTime, breakDuration);
	            remainingTime--;
	
	            if (remainingTime < 0) {
	                clearInterval(interval);
	                blockIndex++;
	                if (blockIndex < $('.block').length) {
	                    showBlock(); // Show the next block after the break
	                } else {
	                    // All blocks completed
	                    $('#ui-timer-txt').text('Done!');
	                    $('#ui-timer-bar').css('width', '100%');
	                }
	            }
	        }, 1000);
	    }
	
	    // Start button click event
	    $('#ui-start').on('click', function() {
		    $('#user-interface').addClass('start');
	        $('#ui-timer-txt').text('3:00');
			$('#ui-timer-bar').css('width', '0%');
	        blockIndex = 0;
	        showBlock();
	    });
	
	    // Next button click event
	    $('#ui-next-block').on('click', function() {
	        $('#ui-timer-txt').text('3:00');
			$('#ui-timer-bar').css('width', '0%');
	        blockIndex = blockIndex + 1;
	        showBlock();
	    });
	
	    // Previous button click event
	    $('#ui-previous-block').on('click', function() {
	        $('#ui-timer-txt').text('3:00');
			$('#ui-timer-bar').css('width', '0%');
		    blockIndex = blockIndex - 1;
	        showBlock();
	    });
	
	    // Stop button click event
	    $('#ui-stop').on('click', function() {
		    setTimeout(function(){
			    $('#user-interface').removeClass('start');
		    }, 1000);
	    });
	});
	
	/*
		SELF DIRECTED WORKOUT
	*/
	
});
})(jQuery);