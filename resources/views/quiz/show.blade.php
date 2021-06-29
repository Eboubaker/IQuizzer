@extends('layout')
@section('title') {{ $quiz->title }} @endsection

@push('header-sources')
    <style>
        @media print {
            nav, .no-print, .btns, footer{
                display: none;
            }
        }
        
    </style>
@endpush
@section('content')
    <?php $empty = count($quiz->usersQuiz) === 0 ?>
    <div class="w-full sans-serif bg-gray-200 pt-8">
        <div class="w-full mb-5">
            <div class="w-full text-center text-4xl">
                {{ $quiz->title }}
            </div>
            <div class="no-print w-full text-center font-semibold mt-3 text-blue-800">
                Your Quiz All Set, Send this link to your Students {{ $empty ? 'to get Started' : ''}}
            </div>
            <div class="no-print flex w-full justify-center ">
                <div onclick="copy(this)" class="focus:outline-none text-gray-600 font-semibold animate-ripple cursor-pointer bg-white mt-1 text-xs sm:text-sm lg:text-md py-2 px-4 rounded-lg shadow-md">
                    <span>{{ $quiz->path }}</span>
                </div>
            </div>
            <div id="copied" class="no-print text-sm text-center w-full text-gray-500">click to copy</div>
        </div>
        <div class="no-print text-center my-3 mx-auto border-t-2 w-11/12 border-{{$empty?'red':'green'}}-600 font-sans text-{{$empty?'red':'green'}}-600 font-semibold">{{$empty?'No one has completed your quiz yet!':'Engaged Users'}}</div>
        <div class="container mx-auto py-6 px-4" x-data="datatables()" x-init="init()" x-cloak>
            <div class="no-print mb-4 flex justify-between items-center">
                <div class="flex-1 pr-4">
                    <div class="relative md:w-1/3" >
                        <input type="search"
                               class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                               placeholder="Search..."
                               x-model="searchval">
                        <div class="absolute top-0 left-0 inline-flex items-center p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </div>

                    </div>
                </div>
                <div>
                    <div class="shadow rounded-lg flex">
                        <div class="relative">
                            <button @click.prevent="open = !open"
                                    class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <path
                                            d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5" />
                                </svg>
                                <span class="hidden md:block">Display</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                 class="z-40 absolute top-0 right-0 w-40 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-1 overflow-hidden">
                                <template x-for="heading in headings">
                                    <label
                                            class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2">
                                        <div class="text-teal-600 mr-3">
                                            <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" checked @click="toggleColumn(heading.key)">
                                        </div>
                                        <div class="select-none text-gray-700" x-text="heading.value"></div>
                                    </label>
                                </template>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="tbl overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
                 style="height: 405px;">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                    <tr class="text-left">
                        <th class="no-print py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                            <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" @click="selectAllCheckbox($event);">
                            </label>
                        </th>
                        <template x-for="heading in headings">
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs"
                                x-text="heading.value" :x-ref="heading.key" :class="{ [heading.key]: true }" :class="{  }"></th>
                        </template>
                    </tr>
                    </thead>
                    <tbody>

                    <template x-for="user in users" :key="user.email">

                        <tr class="hover:bg-blue-100">
                            <td class="no-print border-dashed border-t border-gray-200 px-3">
                                <label
                                        class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    <input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" :name="user.email"
                                           @click="getRowDetail($event, user.email)">
                                </label>
                            </td>
                            {{--                            <td class="border-dashed border-t border-gray-200 userId">--}}
                            {{--                                <span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.userId"></span>--}}
                            {{--                            </td>--}}
                            <td class="border-dashed border-t border-gray-200 name">
                                <span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.name"></span>
                            </td>
                            <td class="hover:bg-blue-200 cursor-pointer border-dashed border-t border-gray-200 point" @click="navigate(user.path)">
                                <span class="text-gray-700 px-6 py-3 flex items-center"
                                      x-text="user.point"></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 email">
                                <span class="text-gray-700 px-6 py-3 flex items-center" x-text="user.email"></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 createdAt">
                                <span class="text-gray-700 px-6 py-3 flex items-center"
                                      x-text="user.createdAt"></span>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>

            </div>
            <div class="btns w-full mt-3">
                <div class="ml-auto" style="width: fit-content">
                    <button @click="window.print()" class="btn bg-transparent text-gray-600 btn-primary mr-3">Print</button>
                    <button @click="download()" class="btn bg-transparent text-gray-600 btn-primary">Download</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {

            var beforePrint = function() {
                $('.tbl').css({height: ''});
            };

            var afterPrint = function() {
                $('.tbl').css({height: 405});
            };

            if (window.matchMedia) {
                var mediaQueryList = window.matchMedia('print');
                mediaQueryList.addListener(function(mql) {
                    if (mql.matches) {
                        beforePrint();
                    } else {
                        afterPrint();
                    }
                });
            }

            window.onbeforeprint = beforePrint;
            window.onafterprint = afterPrint;

        }());
        function datatables() {
            return {
                quizId:'{{ $quiz->id }}',
                fullHeadings: [
                    {
                        'key': 'name',
                        'value': 'Name'
                    },
                    {
                        'key': 'point',
                        'value': 'Point'
                    },
                    {
                        'key': 'email',
                        'value': 'Email'
                    },
                    {
                        'key': 'createdAt',
                        'value': 'Finished at'
                    },
                ],
                headings:[
                    {
                        'key': 'name',
                        'value': 'Name'
                    },
                    {
                        'key': 'point',
                        'value': 'Point'
                    },
                    {
                        'key': 'email',
                        'value': 'Email'
                    },
                    {
                        'key': 'createdAt',
                        'value': 'Finished at'
                    },
                ],
                users: {!! $users !!},
                usersFull: {!! $users !!},
                selectedRows: [],
                searchval: "",
                open: false,

                init()
                {
                    console.log("init");
                    this.$watch('searchval', () => {
                        this.search()
                    });
                },
                search(){
                    let val = this.searchval.toLowerCase();
                    let arr = [];
                    let check = undefined;
                    if(val.length === 0)
                    {
                        check = () => true;
                    }
                    else if(val.indexOf("point>") === 0)
                    {
                        let point = parseFloat(val.substr(6));
                        check = (user) => user.point > point;
                    }
                    else if(val.indexOf("point<") === 0)
                    {
                        let point = parseFloat(val.substr(6));
                        check = (user) => user.point < point;
                    }
                    else if(val.indexOf("email:") === 0)
                    {
                        let email = val.substr(6);
                        check = (user) => user.email.toLowerCase().indexOf(email) >= 0;
                    }
                    else
                    {
                        check = (user) => user.name.toLowerCase().indexOf(val) >= 0;
                    }
                    for (let e of this.usersFull)
                    {
                        if (check(e))
                        {
                            arr.push(e);
                        }
                    }
                    this.users = arr;
                },
                download(){
                    let rows = [this.headings.map((h) => h['key'])];
                    for(let user of this.users)
                    {
                        rows.push([user.name, user.point, user.email, user.createdAt]);
                    }
                    let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
                    var encodedUri = encodeURI(csvContent);
                    var link = document.createElement("a");
                    link.style.display = 'none';
                    link.setAttribute("href", encodedUri);
                    link.setAttribute("download", "quizzer_users.csv");
                    document.body.appendChild(link);
                    link.click();
                },
                toggleColumn(key) {
                    // Note: All td must have the same class name as the headings key!
                    let columns = document.querySelectorAll('.' + key);
                    if (this.$refs[key].classList.contains('hidden') && this.$refs[key].classList.contains(key)) {
                        columns.forEach(column => {
                            column.classList.remove('hidden');
                        });
                    } else {
                        columns.forEach(column => {
                            column.classList.add('hidden');
                        });
                    }
                },

                getRowDetail($event, email) {
                    let rows = this.selectedRows;

                    if (rows.includes(email)) {
                        let index = rows.indexOf(email);
                        rows.splice(index, 1);
                    } else {
                        rows.push(email);
                    }
                },

                selectAllCheckbox($event) {
                    let columns = document.querySelectorAll('.rowCheckbox');

                    this.selectedRows = [];

                    if ($event.target.checked === true) {
                        columns.forEach(column => {
                            column.checked = true;
                            this.selectedRows.push(parseInt(column.name))
                        });
                    } else {
                        columns.forEach(column => {
                            column.checked = false
                        });
                        this.selectedRows = [];
                    }
                },

                navigate(to){
                    window.location.href = to;
                }
            }
        }

        function copy(div){
            if(navigator.clipboard) {
                navigator.clipboard.writeText("{{ $quiz->path }}");
                $("#copied").text("Copied!").css({opacity: 0}).animate({opacity: 1}, 230).removeClass("text-gray-600").addClass("text-green-600");
            }else{
                window.getSelection().selectAllChildren(div);
                window.getSelection().selectAllChildren(div);
                $("#copied").text("Selected!").css({opacity: 0}).animate({opacity: 1}, 230).removeClass("text-gray-600").addClass("text-green-600");
            }
        }
    </script>
@endpush
