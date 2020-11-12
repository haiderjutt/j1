
<div class="row">
    <div class="col-sm-12">
        <div class="row">
        <p style="font-size:12px;  padding-left:15px; color:white; "> <b>Select Customer Name: </b> :</p>
        <!-- <u style="font-size:13px;  padding-left:10px; color:white;"><%myValue1.name%></u> -->
       
            <select ng-options="item.name for item in customlist" style="width:100px; height:25px;" ng-model="myValue1" ng-change="tabledata()" class="onlinetableddvalue"></select>
  
            <!-- <select  ng-model="myValue1" ng-change="tabledata()"  class="onlinetableddvalue">
                <option ng-repeat="item in customlist" ><%item.name%></option>
            </select> -->
        </div>
        <div class="row onlinetabledd" >
            <div class="col onlinetableddd">
                <div class="row" >
                    <p style="font-size:12px;  padding-left:15px;"> <b>Items Per Page </b>  : </p>
                    <u style="font-size:12px;  padding-left:10px;"><%myValue%></u>
                    <select  ng-model="myValue" ng-change="myFunc()"  class="onlinetableddvalue">
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
            <div class="col-sm-6 onlinetablepage" >
                <span class="onlinetablepageno"> <p style="color:white;"> <b>Page</b> : <u><%currentPage+1|json%></u> <b>of</b> <u><%pagedItems.length|json%></u></p></span>
            </div>
            <div class="col" style="text-align: right; float-right;">
                <p><input type="text" ng-model="test" placeholder="Search" class="onlinetablesearch"></p> 
            </div>
        </div> 
        <div class="row">
            <table class="onlinetable">
                <thead class="onlinetableheader">
                    <tr >
                        <th class="name" custom-sort order="'name'" sort="sort" ><b  class="onlinetableheaderth">Name &nbsp;</b> <i class="fa fa-sort" id="flipflop"></i></th>
                        <th class="username" custom-sort order="'username'" sort="sort"><b  class="onlinetableheaderth">Username &nbsp;</b> <i class="fa fa-sort" id="flipflop"></i></th>
                        <th class="email" custom-sort order="'email'" sort="sort"> <b  class="onlinetableheaderth">Email &nbsp;</b><i class="fa fa-sort" id="flipflop"></i></th>
                        <th class="field3" custom-sort order="'field3'" sort="sort"> <b  class="onlinetableheaderth">Phone &nbsp;</b><i class="fa fa-sort" id="flipflop"></i></th>
                        <th class="field5" custom-sort order="'field5'" sort="sort"> <b  class="onlinetableheaderth">Role &nbsp;</b><i class="fa fa-sort" id="flipflop"></i></th>
                        <th class="field6" custom-sort order="'field6'" sort="sort"> <b  class="onlinetableheaderth">Actions &nbsp;</b></th>
                    </tr>
                </thead>       
                <tbody style="font-size: 12px; background-color:#141414; hover:pointer;">
                <tr ng-repeat="item in pagedItems[currentPage] | orderBy:sort.sortingOrder:sort.reverse | filter:test" class="tableentries">
                        <td><%item.name%></td>
                        <td><%item.username%></td>
                        <td><%item.email%></td>
                        <td><%item.phone%></td>
                        <td><%item.role%></td>
                        <td class="menu1">
                            <label class="menu-open-button1">
                                <i class="fa fa-cogs"></i>
                             </label>
                            <button  class="menu-item1 blue btn" title="Remove Allocation" ng-if="item.role == 'Customer'" ng-click="FinalSequence(item,'sm','Delete')" data-toggle="modal" data-target="#FinalModal" ><img class="menu-item1 blue" src="./images/icons/Delete.png" height="50" width="50"></button> 
                            <button  class="menu-item1 blue btn"  title="Allocation" ng-if="item.role != 'Customer' && item.role != 'Super Admin'" ng-click="FinalSequence(item,'lg','Allocation')" data-toggle="modal" data-target="#FinalModal"><i class="fa fa-exchange"></i> </button>
                           
                        </td>
                    </tr>
                    
                </tbody>
            </table>
    
        </div>
    </div>
    </div>
</div> 

<div class="row pagefootert" ng-style="pagefooterstyle"> 
    <div class="col-sm-12">
        <div class="row pagefooter">
            <div class="col-md-6">
             <!-- <button class="btn btn-outline-primary onlinetablecreateuserbtn" ng-click="FinalSequence(item,'lg','Register')" data-toggle="modal" data-target="#FinalModal"><i style="color:white;" class="fa fa-user"></i> Create New User</button>
             <button class="btn btn-outline-primary onlinetablecreateuserbtn" ng-click="AssignSequence(item,'lg','ban')" title="Performance" data-toggle="modal" data-target="#Gridmodal"><i class="fa fa-ban"></i>Assignment</button>
              -->
            </div>
         <div class="col-md-6" style=" text-align: right;">
                <button class="btn btn-secondary onlinetablecreateuserbtn"  ng-class="{disabled:currentPage == 0}">
                <a style="color:white;" href ng-click="prevPage()">« Prev</a>
                </button>
                <button class="btn btn-secondary onlinetablecreateuserbtn"  ng-repeat="n in range(pagedItems.length, currentPage, currentPage + gap) "
                    ng-class="{active: n == currentPage}" ng-click="setPage()"> <a style="color:white;" href ng-bind="n + 1">1</a> 
                </button>
                <button class="btn btn-secondary onlinetablecreateuserbtn"  ng-class="{disabled: (currentPage) == pagedItems.length - 1}">
                        <a style="color:white;" href ng-click="nextPage()">Next »</a> 
                </button> 
         </div>
        </div>      
    </div>
</div>

<!-- Modal -->
<div class="modal" id="FinalModal" tabindex="-1" role="dialog" aria-labelledby="FinalModal" aria-hidden="true">
    <div class="modal-dialog  " role="document" ng-class="{'modal-sm':modaltype == 'sm', 'modal-md':modaltype == 'md','modal-lg':modaltype == 'lg','modal-xl':modaltype == 'xl'}">
        <div class="modal-content">
            <div class="modalheader">
                <h6 class="modal-title" id="FinalModal"><%modalheader%></h6>
            </div>
            <div class="modalbody"  ng-style="modalbodyshow" ng-class="{modalbodyshow:modal == true}">
                <div ng-style="alertbox" style="display:none; width: 100%; height:20px; border:1px solid rgb(128, 218, 68); background:rgba(75, 48, 48, 0.589); border-radius:5px;">
                    <p style="text-align: center; color:white;">Alert: <% serverMessage %><a style="float:right; cursor:pointer;" ng-click="serverAlertHide()"><i class="fa fa-times"></i></a></p>
                </div>
                <div id="CRUDModal">
                    <div  ng-repeat="item in formFields.file" >
                        <label><%item.label%></label>
                        <div class="newregisterimage">
                            <input type="file" custom-on-change="uploadFile" />
                            <img ng-src="<% item.value %>"width="100px" height="100px" alt="Profile Pic">
                        </div>
                    </div>
                     <div ng-repeat="item in formFields.text" >
                        <label><%item.label%></label>
                        <input class="form-control" type="text" ng-model="item.value">
                    </div>
                    <div ng-repeat="item in formFields.dropdown" >
                        <label><%item.label%></label>
                        <select class="form-control" type="text" ng-model="item.value">
                            <option ng-repeat="opt in item.options" value="<%opt%>">
                                <%opt%>
                            </option>
                        </select>
                    </div>
                    
                    
                    
                    <div class="custcard" ng-repeat="item in formFields.allocation">
                        <div class="custcardfirst" >
                            <p>Worker</p>
                            <div class="img" >
                                <img ng-src="<%item.Avatar.url%>" height="80px" width="80px" style="border-radius:50%;" ><br>
                                <i class="fa fa-user"></i>
                                <i class="fa fa-user"></i>
                            </div>
                            <div><% item.Name.label %> : <% item.Name.value %></div>
                            <div><% item.Username.label %> : <% item.Username.value %></div>
                            <div><% item.Email.label %> : <% item.Email.value %></div>
                            <div><% item.Phone.label %> : <% item.Phone.value %></div>
                        </div>
                        <div class="custcardsecond">
                            <p>Allocations</p>
                            <div>
                               <div ng-repeat="row in item.Allocated.customerdetails">
                                   <div>
                                        Name : <% row.name %> <br>
                                        Email : <% row.email %> <br>
                                        Phone : <% row.phone %> <br>
                                   </div>
                                   <div> <img src="./images/user.png" height="80px" width="80px" style="border-radius:50%;" ></div>
                               </div>
                            </div>
                        </div>
                        <div class="custcardthird">
                            <h6>New Allocations</h6>
                             <div>
                                <div>
                                    <select class="form-control" ng-model="CustomerSelect" ng-change="customerdemo(CustomerSelect);">
                                        <option ng-repeat="item in modalCustomers" value="<% item %>" ><% item.name %></option>
                                    </select>
                                </div>
                                <div ng-if="newassign">
                                    <img ng-src="<%newassign.avatar%>" width="100%">
                                </div>
                                <div ng-if="newassign">
                                    Name : <% newassign.name %> <br>
                                    Email : <% newassign.email %> <br>
                                    Phone : <% newassign.phone %> <br>
                                </div>

                                <div class="arrow">
                                   <div>
                                    <div id="arrowAnim">
                                        <div class="arrowSliding">
                                          <div class="arrow"></div>
                                        </div>
                                        <div class="arrowSliding delay1">
                                          <div class="arrow"></div>
                                        </div>
                                        <div class="arrowSliding delay2">
                                          <div class="arrow"></div>
                                        </div>
                                        <div class="arrowSliding delay3">
                                          <div class="arrow"></div>
                                        </div>
                                      </div>
                                   </div> 
                                </div>

                             </div>

                        </div>
                    
                    </div> 
                </div>
            </div>
            <div class="modalfooter" >
              <button type="button" ng-click="ModalRequest()"><%modalbutton%></button>
              <button type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>    
</div>


<div class="modal" id="Gridmodal" tabindex="-1" role="dialog" aria-labelledby="Gridmodal" aria-hidden="true">
    <div class="modal-dialog" ng-class="{'modal-sm':m_type == 'sm', 'modal-lg':m_type == 'lg','modal-xl':m_type == 'xl'}">
        <div class="modal-content">
            <div class="modalheader">
                <h class="modal-title" id="Gridmodal"><%modalheader%></h>
            </div>
            <div id="modalcontent2" class="modalbody" ng-style="modalbodyshow" ng-class="{modalbodyshow:modal == true}">
             <div class="row customermodalheader" >
                  <div class="left">
                    <p>Customer Name: <b>JoynDigital</b></p>
                  </div>
                <div class="right">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="#" data-toggle="tab"  role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-user"> Operator</i> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="#" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-user"> Agent </i> </a>
                            </li>
                        </ul>
                </div>
                      
                  </div>
                  <div class="row">
                  <div class="flex-container">
                  <div>
                      <div> <img src="./images/user.png" ></div>
                      <div> 
                         <div>
                            <div class="classone">
                                <div>lsdkdk;as;d'</div>
                                <div>Name; asdasdasd</div>
                                <div>Name; asdasd</div>
                                <div>Name; sdasdasd</div>
                            </div>
                            <div class="classtwo">
                                <button class="btn" > <i class="fa fa-envelope"></i></button>
                                <button class="btn"> <i class="fa fa-trash"></i></button>
                                <button class="btn"> <i class="fa fa-times"></i></button>
                            </div>
                         </div>
                      </div>
                    </div>
                    <div>
                        <div> <img src="./images/user.png" ></div>
                        <div> 
                           <div>
                              <div class="classone">
                                  <div>lsdkdk;as;d'</div>
                                  <div>Name; asdasdasd</div>
                                  <div>Name; asdasd</div>
                                  <div>Name; sdasdasd</div>
                              </div>
                              <div class="classtwo">
                                  <button class="btn" > <i class="fa fa-envelope"></i></button>
                                  <button class="btn"> <i class="fa fa-trash"></i></button>
                                  <button class="btn"> <i class="fa fa-times"></i></button>
                              </div>
                           </div>
                        </div>
                      </div>
                      <div>
                        <div> <img src="./images/user.png" ></div>
                        <div> 
                           <div>
                              <div class="classone">
                                  <div>lsdkdk;as;d'</div>
                                  <div>Name; asdasdasd</div>
                                  <div>Name; asdasd</div>
                                  <div>Name; sdasdasd</div>
                              </div>
                              <div class="classtwo">
                                  <button class="btn" > <i class="fa fa-envelope"></i></button>
                                  <button class="btn"> <i class="fa fa-trash"></i></button>
                                  <button class="btn"> <i class="fa fa-times"></i></button>
                              </div>
                           </div>
                        </div>
                      </div>
                  </div>
                  <div class="flex-container1">
                    <select id="roleSelect" class="form-control" ng-model="roleSelect" ng-init="roleSelect='Select Role'">
                        <option value="Operator">Operator</option>
                        <option value="Agent">Agent</option>
                    </select> 
                  </div>
                  </div> 
              
            </div>
            <div class="modalfooter" >
              <button type="button" data-dismiss="modal"></button>
              <button type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>    
</div>