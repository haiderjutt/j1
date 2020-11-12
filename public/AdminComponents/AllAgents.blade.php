<div class="row" style="background-color:#17a2ba; padding-top: 13px; border-radius: 5px; color:white;position:relative;">
    <div class="col-sm-3" style="text-align:center;">
        <div class="row" >
            <p style="font-size:12px;  padding-left:15px;"> <b>Items Per Page </b>  : </p>
            <u style="font-size:12px;  padding-left:10px;"><%myValue%></u>
            <select  ng-model="myValue" ng-change="myFunc()" style="width:20px; border-radius: 5px; height:15px; margin-left:5px;" >
                <option value="5" >5</option>
                <option value="25" >25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
            </select>
        </div>
    </div>
    <div class="col-sm-3" style="text-align: center; ">
        <span style="font-size: 12px; border-top: 5px solid red; "> <p style="color:white;"> <b>Page</b> : <u><%currentPage+1|json%></u> <b>of</b> <u><%pagedItems.length|json%></u></p></span>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-5" style="text-align: center;">
        <p><input type="text" ng-model="test" placeholder="Search" style="border-radius: 5px; height:20px;"></p> 
    </div>
</div>  
<div class="row">
    <div class="alertbox col-md-12" ng-style="alertboxjs" ng-model="alertmessage">
        <span class="closebtn" style="color:darkblue;" ng-click="hidealert()">&times;</span> 
        <strong>Alert :</strong> <%alertmessage%>
    </div>  
</div> 
<div class="row">  
    <table class="table table-striped table-condensed table-hover">
        <thead>
            <tr>
                <th class="name" custom-sort order="'name'" sort="sort">Name&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="email" custom-sort order="'email'" sort="sort">Email&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field3" custom-sort order="'field3'" sort="sort">Phone&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field4" custom-sort order="'field4'" sort="sort">Ban Status&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field5" custom-sort order="'field5'" sort="sort">Actions&nbsp;</th>
                <th class="field6" custom-sort order="'field6'" sort="sort">Assignment&nbsp;</th>
            </tr>
        </thead>
        <tfoot>
            <td colspan="12">
                <div class="row pagination" style="display:inline-block; width:100%; text-align:right;">
            
                    <ul >
                        <button  style="font-size:12px;" class="btn btn-info" ng-class="{disabled: currentPage == 0}">
                            <a style="color:white; " href ng-click="prevPage()">« Prev</a>
                        </button>
                        
                        <button style="font-size:12px;" class="btn btn-info" ng-repeat="n in range(pagedItems.length, currentPage, currentPage + gap) "
                        ng-class="{active: n == currentPage}"
                        ng-click="setPage()">
                            <a style="color:white;" href ng-bind="n + 1">1</a>
                        </button>
                        <button style="font-size:12px;" class="btn btn-info" ng-class="{disabled: (currentPage) == pagedItems.length - 1}">
                            <a style="color:white;" href ng-click="nextPage()">Next »</a>
                        </button>
                    </ul>
        
                </div>
            </td>
        </tfoot>
        
            <!-- <pre>currentPage: <%sort|json%></pre> -->

            
        <tbody>
            <tr ng-repeat="item in pagedItems[currentPage] | orderBy:sort.sortingOrder:sort.reverse | filter:test">
                <td><%item.name%></td>
                <td><%item.email%></td>
                <td><%item.phone%></td>
                <td><%item.ban%></td>
                <td>
                    <button class="btn btn-outline-primary" title="Edit" ng-click="GlobalSequencedata(item)" data-toggle="modal" data-target="#UpdateModal" style="font-size:12px; height:30px;"><i class="fa fa-list"></i></button>
                    <button class="btn btn-outline-success" title="Change Pass" ng-click="GlobalSequence(item.id)" data-toggle="modal" data-target="#PassChangeModal" style="font-size:12px;height:30px;"><i class="fa fa-key"></i></button>
                    <button class="btn btn-outline-danger" title="Delete" ng-click="GlobalSequence(item.id)" data-toggle="modal" data-target="#RandomDeleteModal" style="font-size:12px;height:30px;"><i class="fa fa-trash"></i></button>
                    <button class="btn btn-outline-dark" title="Ban" ng-click="GlobalSequenceEdit(item.id,item.ban)" data-toggle="modal" data-target="#BanModal" style="font-size:12px;height:30px;"><i class="fa fa-ban"></i></button>
                </td>
                <td>
                    <button class="btn btn-outline-info" title="Assign Customer" ng-click="fillup(item)" data-toggle="modal" data-target="#customerModal" style="font-size:12px; height:30px;"><i class="fa fa-users"></i></button>
                    <button class="btn btn-outline-success" title="View Performance" ng-click="GlobalSequencedata(item)" data-toggle="modal" data-target="#U" style="font-size:12px; height:30px;"><i class="fa fa-eye"></i></button>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="RandomDeleteModal" tabindex="-1" role="dialog" aria-labelledby="RandomDeleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:lightseagreen; color:white;">
                <h5 class="modal-title" id="RandomDeleteModal">Continue Deleting User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer" style="height:60px;">
                <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="Delete()" style=" font-size:12px;">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-size:12px;">Close</button>
              
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PassChangeModal" tabindex="-1" role="dialog" aria-labelledby="PassChangeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:lightseagreen; color:white;">
                <h5 class="modal-title" id="PassChangeModal">Enter the new password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size:12px;">
              <label>New Password (Min. 4 Characters)</label>
              <input type="text" ng-model="newpass" class="form-control" placeholder="****" style="border-radius:15px;background:lightgray; font-size:12px;">
            </div>
            <div class="modal-footer" style="height:60px;">
              
              <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="PassUpdate()" style=" font-size:12px;">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-size:12px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="UpdateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:lightseagreen; color:white;">
                <h5 class="modal-title" id="UpdateModal">Edit User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size:12px;">
                <label>*Name</label>
                <input type="text" ng-model="editname" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                <label>*Username</label>
                <input type="text" ng-model="editusername" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                <label>*Email</label>
                <input type="text" ng-model="editemail" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                <label>*Phone</label>
                <input type="text" ng-model="editphone" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
            </div>
            <div class="modal-footer" style="height:60px;">
              
              <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="UserUpdate()" style=" font-size:12px;">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-size:12px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="BanModal" tabindex="-1" role="dialog" aria-labelledby="BanModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:lightseagreen; color:white;">
                <h5 class="modal-title" id="BanModal"><%blockheader%></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer" style="height:60px;">
                <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="Ban()" style=" font-size:12px;"><%ActDisp%></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-size:12px;">Close</button>
              
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:lightseagreen; color:white;">
                <h5 class="modal-title" id="customerModal">Customer Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-md-12">Assigned Customers</label>
                    <div class="col-sm-6" ng-repeat="(key,item) in cusName"style="border-radius:25px;background:rgb(255, 255, 255);border:10px solid rgba(0, 0, 0, 0.678);">
                        <p style="margin-top:2px;background:#73b796; color:white; border-radius:5px;text-align:center;">Customer <% key+1 %><a style="float:right;margin-right:3px;cursor:pointer;" title="Remove Assignment" ng-click="deleteassignment(item.customer_id)"><i class="fa fa-times-circle"></i></a></p>
                        <p><b>Name </b> : <q style="float:right"><% item.customer_name %></q></p>
                    </div>
                </div>
                <br>
                <label style="text-align: center; "> Assign New Customer</label>
                <select ng-model="newcus" class="form-control" style="border-radius:15px;text-align:center; font-size:12px; background:lightgray;">
                <option ng-repeat="item in cus" value="<%item.id%>">
                    <% item.name %>
                </option>
                </select>
            </div>
            <div class="modal-footer" style="height:60px;">
                <button type="button" class="btn btn-primary"  ng-click="customerAssign()" style=" font-size:12px;">Assign</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-size:12px;">Close</button>
              
            </div>
        </div>
    </div>
</div>
