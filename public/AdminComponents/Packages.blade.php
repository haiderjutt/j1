

<div class="row onlinetabledd" >
    <div class="col-sm-3 onlinetableddd">
        <div class="row" >
            <p style="font-size:12px;  padding-left:15px;"> <b>Items Per Page </b>  : </p>
            <u style="font-size:12px;  padding-left:10px;"><%myValue%></u>
            <select  ng-model="myValue" ng-change="myFunc()" class="onlinetableddvalue">
                <option value="5" >5</option>
                <option value="25" >25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">500</option>
                <option value="400">1000</option>
                <option value="500">2000</option>
            </select>
        </div>
    </div>
    <div class="col-sm-3 onlinetablepage" >
        <span class="onlinetablepageno"> <p style="color:white;"> <b>Page</b> : <u><%currentPage+1|json%></u> <b>of</b> <u><%pagedItems.length|json%></u></p></span>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-5" style="text-align: center;">
        <p><input type="text" ng-model="test" placeholder="Search" class="onlinetablesearch"></p> 
    </div>
</div>  
<div class="row">
    <div class="alertbox col-md-12" ng-style="alertboxjs" ng-model="alertmessage">
        <span class="closebtn" style="color:darkblue;" ng-click="hidealert()">&times;</span> 
        <strong>Alert :</strong> <%alertmessage%>
    </div>
</div>
<div class="row"> 
    <table class="onlinetable table table-striped table-condensed table-hover">
        <thead class="onlinetableheader">
            <tr>
                <th class="id" custom-sort order="'id'" sort="sort"><b  class="onlinetableheaderth">Id&nbsp; </b><i class="fa fa-sort" id="flipflop"></i></th>
                <th class="name" custom-sort order="'name'" sort="sort"><b  class="onlinetableheaderth">Name&nbsp; </b><i class="fa fa-sort" id="flipflop"></i></th>
                <th class="description" custom-sort order="'description'" sort="sort"><b  class="onlinetableheaderth">Description&nbsp; </b><i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field3" custom-sort order="'field3'" sort="sort"><b  class="onlinetableheaderth">Field 3&nbsp;</b> <i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field4" custom-sort order="'field4'" sort="sort"><b  class="onlinetableheaderth">Field 4&nbsp; </b><i class="fa fa-sort" id="flipflop"></i></th>
                <th class="field5" custom-sort order="'field5'" sort="sort"><b  class="onlinetableheaderth">ield 5&nbsp; </b><i class="fa fa-sort" id="flipflop"></i></th>
            </tr>
        </thead>

        
            <!-- <pre>currentPage: <%sort|json%></pre> -->

            
        <tbody>
            <tr ng-repeat="item in pagedItems[currentPage] | orderBy:sort.sortingOrder:sort.reverse | filter:test">
                <td><%item.id%></td>
                <td><%item.name%></td>
                <td><%item.description%></td>
                <td><%item.field3%></td>
                <td><%item.field4%></td>
                <td>
                    <button class="btn btn-primary" id="<%item.id%>" style="font-size:12px; height:30px;"><i class="fa fa-list"></i></button>
                    <button class="btn btn-danger" id="<%item.id%>" style="font-size:12px;height:30px;"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>

<div class="row pagefootert" ng-style="pagefooterstyle">
    <div class="col-sm-12">
        <div class="row pagefooter">
            <div class="col-md-6">
             <button class="btn btn-outline-primary onlinetablecreateuserbtn" ng-click="FinalSequence(item,'lg','Register')" data-toggle="modal" data-target="#FinalModal"><i style="color:white;" class="fa fa-user"></i> Create New User</button>
             <button class="btn btn-outline-primary onlinetablecreateuserbtn" ng-click="AssignSequence(item,'lg','ban')" title="Performance" data-toggle="modal" data-target="#Gridmodal"><i class="fa fa-ban"></i>Assignment</button>
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
