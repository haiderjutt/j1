app.controller('AdministratorHome', function($scope, $filter, $http, $interval, $rootScope) {

    ///////////initial Data Loading /////////////////////
    var initload = function() {
        $scope.$emit("SendUp", '0');
        var PipelineData = {};
        $http.post('/Latitude/public/administrator/random/all', JSON.stringify(PipelineData)).then(function(response) {
            if (response.data) {
                $scope.customlist = response.data;
            }
        });
        if (global_sequence1) { $scope.tabledata('same'); };
    };
    $scope.tabledata = function(vari) {
        if (vari != 'same') {
            global_sequence1 = $scope.myValue1.id;
        }
        var Pipeline_Data = {
            sequence1: global_sequence1,
        };
        $http.post('/Latitude/public/administrator/workers/all', JSON.stringify(Pipeline_Data)).then(function(response) {
            if (response.data) {
                $scope.items = response.data;
                var customers = [];
                for (var i = 0; i < response.data.length; i++) {
                    if (response.data[i].role == "Customer") {
                        customers.push(response.data[i])
                    }
                }
                $scope.modalCustomers = customers;
                $scope.search();
            } else {
                alert(response.data);
                $scope.alertmessage = "Proper Data Not Obtained. Check Server.";
                $scope.alertboxjs = {
                    'display': "block",
                    'background': "darkred",
                    'color': "white"
                };
            }

        }, function(response) {
            $scope.alertmessage = "Server Error!!!.";
            $scope.alertboxjs = {
                'display': "block",
                'background': "black",
                'color': "white"
            };
        });

    };

    //////////////////////Variable Defination ///////////////////////
    $scope.barChartObject = {};
    $scope.items = [];
    var timer = false;
    var pageNum = 0;
    $scope.myValue = 5;
    $scope.gap = 5;
    $scope.filteredItems = [];
    $scope.groupedItems = [];
    $scope.itemsPerPage = 5;
    $scope.pagedItems = [];
    $scope.currentPage = 0;
    $scope.formFields = { "text": {}, "dropdown": {}, "file": {}, "allocation": {} };
    $scope.modal = true;
    $scope.FuncType = "";
    $scope.sort = {
        sortingOrder: 'id',
        reverse: false
    };
    $scope.serverMessage = 'none';
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////// Table Functions /////////////////////////////////

    ////////
    $scope.myFunc = function() {
        $scope.itemsPerPage = $scope.myValue;
        $scope.search();
    };
    ////////
    var searchMatch = function(haystack, needle) {
        if (!needle) {
            return true;
        }
        return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
    };

    ////////
    $scope.search = function() {
        $scope.filteredItems = $filter('filter')($scope.items, function(item) {
            for (var attr in item) {
                if (searchMatch(item[attr], $scope.query))
                    return true;
            }
            return false;
        });
        // take care of the sorting order
        if ($scope.sort.sortingOrder !== '') {
            $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sort.sortingOrder, $scope.sort.reverse);
        }
        $scope.currentPage = 0;
        // now group by pages
        $scope.groupToPages();
    };
    ////////////
    $scope.groupToPages = function() {
        $scope.pagedItems = [];
        for (var i = 0; i < $scope.filteredItems.length; i++) {
            if (i % $scope.itemsPerPage === 0) {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [$scope.filteredItems[i]];
            } else {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
            }
        }
    };
    ////////////
    $scope.range = function(size, start, end) {
        var ret = [];
        // console.log(size,start, end);
        if (size < end) {
            end = size;
            start = 0;
        }
        for (var i = start; i < end; i++) {
            ret.push(i);
        }
        //console.log(ret);        
        return ret;
    };
    ////////////
    $scope.prevPage = function() {
        if ($scope.currentPage > 0) {
            $scope.currentPage--;
        }
    };
    ///////////////
    $scope.nextPage = function() {
        if ($scope.currentPage < $scope.pagedItems.length - 1) {
            $scope.currentPage++;
        }
    };
    //////////////
    $scope.setPage = function() {
        $scope.currentPage = this.n;
    };

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $scope.serverAlertShow = function($message) {
        $scope.serverMessage = $message;
        $scope.alertbox = {
            'display': "block"
        };
    };
    $scope.serverAlertHide = function() {
        $scope.alertbox = {
            'display': "none"
        };
    };
    $scope.GlobalSequence = function(sequence) {
        pageNum = $scope.currentPage;
        global_sequence = sequence;
    };
    $scope.customerdemo = function(item) {
        var final = JSON.parse(item);
        final.avatar = './avatars/' + final.avatar;
        $scope.newassign = final;
    };
    //My Functions
    $scope.AssignSequence = function(item, modaltype, fields) {
        $scope.addModalClass("modalcontent2");
        var iterate = 0;
        var modallength = 0;
        $scope.modalbodyshow = {
            "height": "0px"
        };
        timer = $interval(function() { console.log(iterate);
            iterate++; if (iterate >= 1) { $scope.addModalHeight(iterate + "00px"); }; if (iterate >= 5) { $interval.cancel(timer);
                $scope.removeModalClass("modalcontent2"); } }, 100);
        pageNum = $scope.currentPage;
        $scope.m_type = modaltype;
        $scope.modal = true;
    };
    $scope.FinalSequence = function(item, modaltype, functiontype) {
        $scope.serverAlertHide();
        var iterate = 0;
        var modallength = 0;
        $scope.FuncType = functiontype;
        if (item != null) {
            global_sequence = item.id;
            pageNum = $scope.currentPage;
        }
        $scope.addModalClass("CRUDModal");
        $scope.formFields.text = {};
        $scope.formFields.dropdown = {};
        $scope.formFields.file = {};
        $scope.formFields.allocation = {};
        $scope.modalbodyshow = {
            "height": "0px"
        };
        timer = $interval(function() { iterate++; if (iterate >= 1) { $scope.addModalHeight(modallength); }; if (iterate >= 3) { $interval.cancel(timer);
                $scope.removeModalClass("CRUDModal"); } }, 100);
        $scope.modaltype = modaltype;
        $scope.modal = true;
        switch (functiontype) {
            case 'Register':
                $scope.modalheader = "Register New User";
                $scope.modalbutton = "Register";
                $scope.formFields.text = administratorside.Register.text_fields;
                $scope.formFields.dropdown = administratorside.Register.dropdown_fields;
                $scope.formFields.file = administratorside.Register.file_fields;
                modallength = 450 + 'px';
                break;
            case 'Update':
                administratorside.Update.text_fields.Name.value = item.name;
                administratorside.Update.text_fields.Username.value = item.username;
                administratorside.Update.text_fields.Email.value = item.email;
                administratorside.Update.text_fields.Phone.value = item.phone;
                administratorside.Update.file_fields.Avatar.value = './avatars/' + item.avatar;
                $scope.modalheader = "Edit User Credentials";
                $scope.modalbutton = "Update";
                $scope.formFields.text = administratorside.Update.text_fields;
                $scope.formFields.file = administratorside.Update.file_fields;
                modallength = 400 + 'px';
                break;
            case 'Delete':
                $scope.modalheader = "Delete User";
                $scope.modalbutton = "Delete";
                modallength = 30 + 'px';
                break;
            case 'Ban':
                modallength = 30 + 'px';
                if (item.ban == "yes") {
                    $scope.modalheader = "Unban User";
                    $scope.modalbutton = "Unban";
                } else {
                    $scope.modalheader = "Ban User";
                    $scope.modalbutton = "Ban";
                }
                break;
            case 'Password':
                $scope.modalheader = "Change Password";
                $scope.modalbutton = "Update";
                $scope.formFields.text = administratorside.Password.text_fields;
                modallength = 100 + 'px';
                break;
            case 'Allocation':
                $scope.modalheader = "Worker Allocation";
                $scope.modalbutton = "Assign";
                administratorside.Allocation.workerdetails.Name.value = item.name;
                administratorside.Allocation.workerdetails.Username.value = item.username;
                administratorside.Allocation.workerdetails.Email.value = item.email;
                administratorside.Allocation.workerdetails.Phone.value = item.phone;
                administratorside.Allocation.workerdetails.Avatar.url = './avatars/' + item.avatar;
                $scope.formFields.allocation = administratorside.Allocation;
                modallength = 500 + 'px';
                break;

            default:
                // code block
                break;
        }
    };
    $scope.addModalClass = function(id) {
        document.getElementById(id).classList.add("open");
    };
    $scope.addModalHeight = function(hei) {
        $scope.modalbodyshow = {
            "height": hei
        };
    };
    $scope.removeModalClass = function(id) {
        if (document.getElementById(id).classList.contains("open")) {
            document.getElementById(id).classList.remove("open");
        }

    };


    ////////////////////////////////////////////////////////////////////////////////

    $scope.ModalRequest = function() {
        var Req_Url = '/Latitude/public/administrator/user/crud';
        //console.log(adminside);
        var Pipeline_Data = {
            sequence: global_sequence,
            sequence1: global_sequence1,
            data: administratorside,
            type: $scope.FuncType
        };
        $scope.TablePostCall(Req_Url, Pipeline_Data);
    };
    $scope.TablePostCall = function(Req_Url, Pipeline_Data) {
        $http.post(Req_Url, JSON.stringify(Pipeline_Data)).then(function(response) {
            if (response.data && !response.data['err']) {
                $scope.serverAlertShow('Successful.');
                $scope.items = response.data;
                $scope.search();
                $scope.currentPage = pageNum;
            } else if (response.data['err'] == "404") {
                $scope.serverAlertShow('Ambiguous Response from the server.');
            } else {
                $scope.serverAlertShow('Server Didnot Respond.');
            }

        }, function(response) {
            $scope.alertmessage = "Server Error!!!.";
            $scope.serverAlertShow('Out of bound Response.');
        });
    };
    $scope.uploadFile = function() {
        var file = event.target.files[0];
        var Req_Url = '/Latitude/public/administrator/user/crud';
        const formData = new FormData();
        formData.append('file', file);
        formData.append('type', 'ProfilePicture');
        formData.append('sequence', global_sequence);
        formData.append('sequence1', global_sequence1);
        formData.append('data', global_sequence);
        $http.post(Req_Url, formData, { headers: { 'Content-Type': undefined } }).then(function(response) {
            if (response.data && !response.data['err']) {
                $scope.alertmessage = "Success";
                $scope.alertboxjs = {
                    'display': "block",
                    'background': "lightgray",
                    'color': "black"
                };
                $scope.items = response.data;
                $scope.currentPage = pageNum;
                administratorside.Update.file_fields.Avatar.value = './avatars/' + file.name;
                $scope.search();
            }
        });
    };

    ////////
    $scope.$on('eventBroadcastedName', function() {
        if ($scope.footerstate) {
            $scope.pagefooterstyle = {
                "width": "94vw",
                "transition": "margin .3s",
            }
        } else {
            $scope.pagefooterstyle = {
                "width": "82vw",
                "transition": "margin .3s",

            }
        }
    });
    ///////
    $scope.search();
    initload();
    initload();
    //$scope.Footerfunction();
    // $interval( function(){ $scope.valuechecking(); }, 2000);
});