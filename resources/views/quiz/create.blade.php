@extends('layout')
@section('title') New Quiz @endsection

<?php $input = session()->getOldInput(); ?>
@section('content')
    @if($errors->count())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <form name="create" class="justify-center py-5 px-12" action="{{ route('quiz.store') }}" method="post">
        <div class="question-block mx-auto w-2/3 block" style="margin-bottom: 5.375rem">
            <div class="items-center text-center pt-10">
                <h2 class="text-4xl tracking-tight">New Quiz</h2>
            </div>
            <input value="{{ old('title') }}" name="title" placeholder="Quiz Title" class="quiz-title py-3 px-2 w-full appearance-none focus:border-blue-300 block mx-0  bg-white text-gray-900 font-medium border border-gray-400 rounded-lg  leading-tight focus:outline-none @error('title')  border-red-600 error @enderror">
            <small class="text-sm ml-2 text-red-600">@error('title') {{ $message }} @enderror</small>
        </div>
        <div class="flex justify-center">
            <button id="removeq" class="btn-neutral hidden focus:outline-none appearance-none mx-2 w-56
            border rounded-lg py-3 px-2 leading-tight font-semibold uppercase
            animate-ripple bg-none border-red-400 text-red-600 cursor-pointer"
                    onclick="remove()" type="button"
            >
                <span style="transform: translateY(.4rem);" class="material-icons text-center">delete</span>
                <span class="btntxt">Remove</span></button>

            <button id="previousq" class="btn-neutral hidden focus:outline-none appearance-none mx-2 w-56
            border rounded-lg py-3 px-2 leading-tight font-semibold uppercase
            focus:outline-none
            animate-ripple border-yellow-400 text-yellow-500 cursor-pointer"
            onclick="previous()"
             type="button"><span style="transform: translateY(.4rem);" class="btn-neutral material-icons text-center"
                >arrow_back</span> <span class="btntxt">Previous</span></button>
            <button id="nextq" class="btn-neutral focus:outline-none appearance-none mx-2 w-56
            border rounded-lg py-3 px-2 leading-tight font-semibold uppercase
            animate-ripple border-green-700 text-green-700 cursor-pointer"
                   onclick="nextQuestion()" type="button">
                <span class="btntxt">Questions</span>
                <span style="transform: translateY(.4rem);" class="material-icons text-center">arrow_forward</span></button>

            <button id="submitf" class="bg-blue-400 text-white hover:bg-transparent hover:border-blue-400 hover:text-blue-400 transition-colors duration-300 hidden focus:outline-none appearance-none mx-2 w-56
            border rounded-lg py-3 px-2 leading-tight font-semibold uppercase
             cursor-pointer"
                    type="button">
                <span class="btntxt">Finish</span>
                <span style="transform: translateY(.4rem);" class="material-icons text-center">done</span></button>
            @csrf
            <input hidden name="total_points">
        </div>
        <div class="summary hidden">
            <div class="flex justify-between my-2">
                <h2 class="text-2xl ">Quiz Summary</h2>
                <button type="button" onclick="document.forms['create'].submit()" class="uppercase font-semibold tracking-wide rounded-lg py-2 px-3 border bg-blue-500 text-white hover:bg-white hover:text-blue-500 border border-blue-500 transition-colors duration-300 focus:outline-none focus:border-green-500">Create</button>
            </div>
            <hr/>
            <div class="grid grid-auto-left gap-5 mt-5">
                <span class="font-semibold">Title</span>          <span class="sum-title"></span>
                <span class="font-semibold">Total Points</span>   <span class="sum-points"></span>
                <span class="font-semibold">Questions</span>   <span class="sum-qcount"></span>
            </div>
            <h2 class="text-2xl mt-5">Quiz Questions</h2>
            <hr/>
            <div class="sum-qs-container m-0 p-0"></div>
            <div class="flex justify-center">
                <button type="button" onclick="document.forms['create'].submit()" class="mx-auto w-48 btn-primary">Create</button>
            </div>
        </div>
    </form>
{{--    <span onclick="$(this).parents('.popper-tooltip').remove()" class="cursor-pointer border border-red-300 bg-red-400 rounded-full absolute material-icons md-18" style="top: -1.1rem;right: -1.1rem">close</span>--}}

@endsection

@push('scripts')
<script>
    let form = $(document.forms['create']);
    let summary = $('.summary');
    form.find('.question-block>textarea').each(function () {
        this.setAttribute('style', 'height:' + (Math.min(Math.max(0,this.scrollHeight)), 200) + 'px;overflow-y:hidden;');
    });
    let summaryChoiceTemplate = $(`<div class="border p-5 text-center rounded" style="max-width: 25%;"></div>`);
    let summaryQuestionTemplate = $(`<div class="sum-q mt-5 grid justify-items-center">
                    <div class="sum-qnumber text-center text-3xl text-gray-800"></div>
                    <div class="sum-qtext text-center mt-2 font-sans font-semibold text-lg max-w-lg"></div>
                    <div class="sum-choices flex gap-10 flex-wrap justify-center w-75 mt-4"></div>
                    <div class="felx justify-center">
                        <button data-question-number onclick="modifyQuestion(this)" type="button" class="sum-qmodify shadow-md text-xs text-gray-500 border-b border-gray-500 hover:text-blue-400 border-blue-400 transition-colors duration-300 focus:outline-none focus:border-green-500">Modify</button>
                    </div>
                    <hr class="w-75 mx-auto my-4 border-gray-300" />
                </div>`);
    function modifyQuestion(button){
        button = $(button);
        let questionBlocks = $(".question-block");
        let questionBlock = questionBlocks.eq(button.data('question-number'));
        summary.hide();
        activateButton(nextBtn);
        activateButton(submitBtn);
        if(!questionBlock.is(questionBlocks.first())){
            activateButton(previousBtn);
        }
        if(questionBlocks.length >= 5){
            activateButton(removeBtn);
        }
        showQuestion(questionBlock);
    }
    let errorPopup = $(`
                    <div style="max-width: 40rem" class='popper-tooltip'>
                        <div class="relative">
                            <svg onclick="$(this).parents('.popper-tooltip').remove()" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            <div class="text-center error-text p-1" style="max-width: 15rem;">{$InputError}</div>
                        </div>
                        <div class="popper-arrow" data-popper-arrow></div>
                    </div>`).hide();
    // showErrorToolTip(form.find('.quiz-title'), "This is an order");
    function showErrorToolTip(target, text, position='top'){
        Popper.createPopper(target[0],
            errorPopup.clone().insertAfter(form).css('opacity', 0).show()
                .animate({opacity:1}, 400)
                .find('.error-text').text(text).parents('.popper-tooltip')[0],
            {
                placement:position,
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                ]
            }
        );

    }
    function appendQuestion(){
        let qid = $('.question-block').length - 1;
        let last = form.find('.question-block:last');
        let q = $(`
            <div class="question-block bg-gray-100 d-flex my-12 p-1">
                <label class="question-number text-2xl block text-center mb-2">Question ${qid + 1}</label>
                <div class="flex">
                    <div>
                        <input name="questions[${qid}][point]" placeholder="Point" type="number" step=".25" min=".25" class="question-point h-12 w-24 mr-2 block bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none">
                        <small class="question-point-error error-text text-sm ml-2 text-red-600"></small>
                    </div>
                    <div class="w-full">
                        <textarea rows="1" name="questions[${qid}][question]" placeholder="Question" class="question-name appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none"></textarea>
                        <small class="question-name-error error-text text-sm ml-2 text-red-600"></small>
                    </div>
                </div>
                <div class="grid grid-cols-2 justify-items-start gap-2" style="grid-template-columns: auto 1fr">
                    <div class="pt-2">
                        <button onclick="appendChoice(this)" type="button" class="btn-neutral inline-block add-choice animate-ripple focus:outline-none my-auto py-1 px-2 mx-1 bg-none border border-green-400 text-green-400 rounded">
                            <span style="transform: translateY(.2rem)" class="material-icons">add</span>
                        </button>
                        <button disabled onclick="deleteChoice(this)" type="button" class="btn-neutral inline-block delete-choice animate-ripple focus:outline-none my-auto py-1 px-2 mx-1 bg-none border border-red-500 text-red-500 rounded">
                            <span style="transform: translateY(.2rem)" class="material-icons">remove</span>
                        </button>
                    </div>
                    <div class="choices-block grid grid-cols-4 w-full">
                        ${makeChoice(qid, 'Correct answer', 'green')[0].outerHTML}
                        ${makeChoice(qid, 'Wrong answer', 'red')[0].outerHTML}
                        ${makeChoice(qid, 'Wrong answer', 'red')[0].outerHTML}
                    </div>
                </div>
            </div>
        `);
        q.find('textarea').on('input', function () {
            if(this.height < 200) {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            }
        });
        q.insertAfter(last);
        return q;
    }
    function appendChoice(button){
        button = $(button);
        let questionBlock = form.find('.question-block:visible:first');
        if(questionBlock.find('.choice-block').length === 3){
            questionBlock.find('.delete-choice').show();
        }
        makeChoice(qIndex(questionBlock)-1 , 'Wrong answer', 'red').insertAfter(questionBlock.find('.choice-block:last'));
        if(questionBlock.find('.choice-block').length >= 8){
            button.attr('disabled', true);
        }
        if(questionBlock.find('.delete-choice').is(':disabled')){
            questionBlock.find('.delete-choice').removeAttr('disabled');
        }
    }

    function makeChoice(qid, prompt, col){
        return $(`
            <div class="choice-block box-border w-full py-1 pr-1">
                <input name="questions[${qid}][choices][]" placeholder="${prompt}" class="question-choice border-box appearance-none block w-full bg-white text-grey-900 font-medium border border-${col}-400 rounded-lg py-3 px-3 leading-tight focus:outline-none">
            </div>
        `);
    }
    function deleteChoice(button){
        let questionBlock = $('.question-block:visible:first');
        questionBlock.find('.choice-block:last').remove();
        if(questionBlock.find('.choice-block').length === 3){
            $(button).attr('disabled', true);
        }
        if(questionBlock.find('.add-choice').is(':disabled')){
            questionBlock.find('.add-choice').removeAttr('disabled');
        }
    }
    let previousBtn = $('#previousq');
    let nextBtn = $('#nextq');
    let removeBtn = $('#removeq');
    let submitBtn = $('#submitf');
    function previous(){
        let currentBlock = $('.question-block:visible');
        currentBlock.hide();
        showQuestion(currentBlock.prev());
        let qindex = qIndex(currentBlock);
        if(qindex === 1){
            disableButton(previousBtn);
            disableButton(removeBtn);
        }
        nextBtn.children('.btntxt').text('Next question')
        if(qindex === 2){
            previousBtn.children('.btntxt').text('Quiz title');
        }
    }
    function nextQuestion(){
        let currentBlock = $('.question-block:visible');
        if(form.find('.question-block:last').is(currentBlock)){
            currentBlock.hide();
            showQuestion(appendQuestion());
        }else{
            showQuestion(currentBlock.next('.question-block'));
            currentBlock.hide();
        }
        if(form.find('.question-block:last').is('.question-block:visible')){
            nextBtn.children('.btntxt').text('New question');
        }
        let qindex = qIndex(currentBlock);
        if(qindex === 0){
            activateButton(previousBtn);
            previousBtn.children('.btntxt').text('Quiz title');
        }
        if(qindex > 0){
            previousBtn.children('.btntxt').text('Previous question');
        }
        let len = $('.question-block').length;
        if(len > 4){
            activateButton(removeBtn)
        }
        if(len > 3){
            activateButton(submitBtn);
        }
    }
    function activateButton(btn){
        btn.show();
        btn.removeAttr('disabled');
    }
    function disableButton(btn){
        btn.attr('disabled', true);
    }
    function remove(){
        let currentBlock = $('.question-block:visible');
        let qindex = qIndex(currentBlock);
        if(qindex === 1){
            disableButton(previousBtn);
        }
        let next = currentBlock.next();
        showQuestion(currentBlock.prev());
        currentBlock.remove();
        let len = $('.question-block').length;
        if(len <= 4 || qindex === 1){
            disableButton(removeBtn);
        }
        if(qindex === 1){
            nextBtn.children('.btntxt').text('Questions')
        }
        if(next.is('.question-block')){
            $('.question-number').each(function(index, elem){
                $(elem).text('Question ' + (index+1));
            });
        }
    }
    function showQuestion(q){
        q.css('opacity', 0).show().animate({opacity:1}, 200);
    }
    function hideErrors(){
        $('.popper-tooltip').remove();
    }
    submitBtn.click(submit);
    function submit(){
        hideErrors();
        let blocks = $('.question-block');
        let currentBlock = $('.question-block:visible').hide();
        let titleBlock = blocks.first();
        let titleInput = titleBlock.find('.quiz-title');
        if(titleInput.val().length < 4){
            titleBlock.find('small:first').text('Quiz title must be at least 5 characters long');
            titleInput.addClass('border-red-600');
            titleBlock.show();
            disableButton(previousBtn);
            nextBtn.children('.btntxt').text('Next question');
            return false;
        }
        activateButton(previousBtn);
        let failed = false;
        let qblocks = blocks.not(':first');
        qblocks.each(function(index, questionBlock){
            questionBlock = $(questionBlock);
            let questionInput = questionBlock.find(`.question-name`);
            if(questionInput.val().length < 8){
                showQuestion(questionBlock);
                showErrorToolTip(questionInput, "Question must be at least 8 characters long");
                failed = true;
                return false;
            }
            if(questionBlock.find('.question-point').val().length === 0){
                showQuestion(questionBlock);
                showErrorToolTip(questionBlock.find('.question-point'), "Question point must be greater than 0");
                failed = true;
                return false;
            }
            questionBlock.find('.choice-block').each(function(index, choiceBlock){
                choiceBlock = $(choiceBlock);
                if(choiceBlock.find('.question-choice').val().length === 0)
                {
                    showQuestion(questionBlock);
                    showErrorToolTip(choiceBlock, "Choice can't be empty");
                    failed = true;
                    return false;
                }
            });
            if(failed)
                return false;
        });
        if(failed){
            return false;
        }
        // Success, now show summary.
        previousBtn.hide();
        nextBtn.hide();
        submitBtn.hide();
        removeBtn.hide();
        let summaryQuestionsContainer = summary.find('.sum-qs-container').empty();
        summary.find('.sum-title').text(titleInput.val());
        summary.find('.sum-qcount').text(qblocks.length);
        let points = 0.0;
        qblocks.each(function (index, question){
            question = $(question);
            points += parseFloat(question.find(".question-point").val());
            let q = summaryQuestionTemplate.clone();
            q.find('.sum-qnumber').text("Question " + (index+1));
            q.find('.sum-qtext').text(question.find('.question-name').val());
            q.find('.sum-qmodify').data('question-number', index+1);
            let summaryChoicesContainer = q.find('.sum-choices');
            let choices = question.find('.question-choice');
            summaryChoicesContainer.append(summaryChoiceTemplate.clone().addClass('border-green-400').text(choices.first().val()));
            choices.slice(1).each(function(index, choice){
                choice = $(choice);
                summaryChoicesContainer.append(summaryChoiceTemplate.clone().addClass('border-red-400').text(choice.val()));
           });
           summaryQuestionsContainer.append(q);
        });
        summary.find('.sum-points').text(points);
        form.find('input[name=total_points]').val(points);
        summary.show();
    }
    function qIndex(questionBlock){
        return questionBlock.index('.question-block');
    }
    $(document).on('keydown','input,textarea', hideErrors);
</script>
@endpush