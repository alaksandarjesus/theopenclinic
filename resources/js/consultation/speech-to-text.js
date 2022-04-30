jQuery(function () {

    const speechToText = jQuery(".speech-to-text");

    if (_.isEmpty(speechToText)) {
        return;
    }

    let recognition, instructions, targetElement, recognising;
    try {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
    } catch (e) {
        console.log("No support for speech to text");
        const args = {
            title: 'No support for Speech To Text',
            body: 'Try the application in latest chrome. If the problem persists,notify administrator',
        }
        window.twAlertModal(args);
        return;
    }

    recognition.onstart = function () {
        recognising = true;
        instructions.text('Voice recognition activated. Try speaking into the microphone.');
    }

    recognition.onspeechend = function () {
        recognising = false;
        instructions.text('You were quiet for a while so voice recognition turned itself off.');
    }

    recognition.onerror = function (event) {
        recognising = false;
        if (event.error == 'no-speech') {
            instructions.text('No speech was detected. Try again.');
        };
    }

    recognition.continuous = true;

    recognition.onresult = function (event) {

        // event is a SpeechRecognitionEvent object.
        // It holds all the lines we have captured so far. 
        // We only need the current one.
        var current = event.resultIndex;

        // Get a transcript of what was said.
        var transcript = event.results[current][0].transcript;

        // Add the current transcript to the contents of our Note.
        // There is a weird bug on mobile, where everything is repeated twice.
        // There is no official solution so far so we have to handle an edge case.
        var mobileRepeatBug = (current == 1 && transcript == event.results[0][0].transcript);
       
        if (!mobileRepeatBug) {
            const val = targetElement.val();
            targetElement.val(val + transcript);
        }
    };

    speechToText.on('click', function () {
        const status = jQuery(this).attr('data-status');
        instructions = jQuery(this).closest('.form-group').find(".speech-to-text--instructions");
        const target = jQuery(this).attr('data-target');
        targetElement = jQuery(this).closest('.form-group').find(target);
        if (_.isEqual(_.toLower(status), 'on')) {
            jQuery(this).text('Start');
            jQuery(this).attr('data-status', 'off');
            recognition.stop();
            return;
        }
       
        setTimeout(()=>{
            jQuery(this).text('Stop');
            jQuery(this).attr('data-status', 'on');
            recognition.start();
        });
      
    });

    jQuery(".tab-btn-examination").on('click', function(){
       resetRecognition();
    });

    jQuery(".tab-btn-complaints").on('click', function(){
        resetRecognition();

    });

    jQuery(".tab-btn-others").on('click', function(){
        resetRecognition();

    });

    function resetRecognition(){
        if(recognising){
            recognition.stop();
        }
        recognising = false;
        jQuery("button.speech-to-text").attr('data-status', 'off');
        jQuery("button.speech-to-text").text('Start');
        jQuery("button.speech-to-text").closest('.form-group').find(".speech-to-text--instructions").text('');
    }

});