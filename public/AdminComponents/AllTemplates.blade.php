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
    <table class="table table-striped table-condensed table-hover " >
        <thead>
            <tr>
                <th class="name" custom-sort order="'name'" sort="sort">Name&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field1" custom-sort order="'field1'" sort="sort">Scopes&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="email" custom-sort order="'email'" sort="sort">IoT Features&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field3" custom-sort order="'field3'" sort="sort">Camera &nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field4" custom-sort order="'field4'" sort="sort">Live Tracking&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field6" custom-sort order="'field6'" sort="sort">Analytics&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field7" custom-sort order="'field7'" sort="sort">Hardware Analytics&nbsp; <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field8" custom-sort order="'field9'" sort="sort">Actions&nbsp;</th>
                <th class="field9" custom-sort order="'field10'" sort="sort">Config&nbsp;</th>
            </tr>
        </thead>
        <tfoot>
            <td colspan="3">
                <button class="btn btn-primary" ng-click="GlobalSequence(0)"  data-toggle="modal" data-target="#NewTemplateModal" style="font-size:12px;"><i style="color:black;" class="fa fa-cubes"></i> Create New Template</button>
            </td>
            <td colspan="6">
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
                <td><%item.template_name%></td>
                <td><%item.allowed_scope%></td>
                <td><%item.allowed_iot%></td>
                <td><%item.allowed_camera%></td>
                <td><%item.agent_tracking%></td>
                <td><%item.analytics%></td>
                <td><%item.hardware_analytics%></td>

                <td>
                    <button class="btn btn-outline-primary" title="Edit" ng-click="GlobalSequencedata(item)" data-toggle="modal" data-target="#UpdateModal" style="font-size:12px; height:30px;"><i class="fa fa-list"></i></button>
                    <button class="btn btn-outline-danger" title="Delete" ng-click="GlobalSequence(item.id)" data-toggle="modal" data-target="#RandomDeleteModal" style="font-size:12px;height:30px;"><i class="fa fa-trash"></i></button>
                </td>
                <td>
                    <a class="btn btn-outline-info" title="Field Configurations" href="#!InternalTemplate" ng-click="GlobalSequencedata(item)"  style="font-size:12px; height:30px; "><i class="fa fa-cog"> </i> </a>
                    <button class="btn btn-outline-secondary" title="View Forms" ng-click="GlobalSequence(item.id)"  style="font-size:12px; height:30px; "><i class="fa fa-eye"> </i> </button>
                    <button class="btn btn-outline-success" title="View Customer" ng-click="GlobalSequence(item.id)"  style="font-size:12px; height:30px; "><i class="fa fa-eye"> </i> </button>
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
                    <h5 class="modal-title" id="RandomDeleteModal">Continue Deleting Template??</h5>
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
  


    <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="UpdateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:lightseagreen; color:white;">
                    <h5 class="modal-title" id="UpdateModal">Edit Template Options</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size:12px;">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Template Name</label>
                            <input type="text" ng-model="editname" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Scopes</label>
                            <select ng-model="editscope" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Camera</label>
                            <select ng-model="editcamera" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>App Data Upload</label>
                            <select ng-model="editapp" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Documents</label>
                            <select ng-model="editdocs" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>IoT Features</label>
                            <select ng-model="editiot" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Sensors per Site</label>
                            <select ng-model="editsensornum" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option data-ng-repeat="i in [0,1,2,3,4,5,6,7,8,9,10,15,20,25,30]"><%i%></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Analytics</label>
                            <select ng-model="editanalytics" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Agent Tracking</label>
                            <select ng-model="editagent" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Hardware</label>
                            <select ng-model="edithardware" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Hardware Analytics</label>
                            <select ng-model="edithardwareanalytics" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="height:60px;">
                  
                  <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="TemplateUpdate()" style=" font-size:12px;">Update</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-size:12px;">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="NewTemplateModal" tabindex="-1" role="dialog" aria-labelledby="NewTemplateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:lightseagreen; color:white;">
                    <h5 class="modal-title" id="NewTemplateModal">Create New Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size:12px;">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Template Name</label>
                            <input type="text" ng-model="newname" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Scopes</label>
                            <select ng-model="newscope" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Camera</label>
                            <select ng-model="newcamera" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>App Data Upload</label>
                            <select ng-model="newapp" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Documents</label>
                            <select ng-model="newdocs" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>IoT Features</label>
                            <select ng-model="newiot" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Sensors per Site</label>
                            <select ng-model="newsensornum" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option data-ng-repeat="i in [0,1,2,3,4,5,6,7,8,9,10,15,20,25,30]"><%i%></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Analytics</label>
                            <select ng-model="newanalytics" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Agent Tracking</label>
                            <select ng-model="newagent" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Allowed Hardware</label>
                            <select ng-model="newhardware" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Hardware Analytics</label>
                            <select ng-model="newhardwareanalytics" class="form-control" style="border-radius:15px;background:lightgray; font-size:12px;">
                                <option>no</option>
                                <option>yes</option>
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer" style="height:60px;">
                  
                  <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="NewTemplate()" style=" font-size:12px;">Create</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-size:12px;">Close</button>
                </div>
            </div>
        </div>
    </div>
