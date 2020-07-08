//check all 0,5 seconds if all questions are answered
setInterval(checkIfALLfilled, 500);

/**
 * enable the submit button when all questions are answered
 */
function checkIfALLfilled() {
    //number of questions which have to be answered 
    var questionCount = document.getElementsByClassName('questionCard').length;
    //already answered questions
    var answeredQuestions = 0;

    //get input tags
    var ele = document.getElementsByTagName('input');

    for (i = 0; i < ele.length; i++) {
        //check if element is a radio input
        if (ele[i].type == "radio") {

            //check if radio input is used
            if (ele[i].checked) {
                answeredQuestions++;
            }
        }
    }


    // enable submit button when all radio inputs are used
    if (answeredQuestions === questionCount) {
        document.getElementById('submitDisabled').disabled = false;
        document.getElementById('submitDisabled').id = 'submit';
    }
}