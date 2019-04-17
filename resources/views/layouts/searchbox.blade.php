<div class="row">
        <div class="col-lg-12 ">
            <div class="card-box col-lg-12">
                <h4 class="header-title m-t-0">Search for Donors/Receipts</h4>

                <div class="col-lg-12">
					<form class="form-horizontal" role="form" id='searchfrm' action='javascript:submitfrm()'>
					    <div class="input-group" align='center'>
		
						      <input type="text" id='search' class="form-control" placeholder="Enter Mobile,Email,PAN,Name or Receipt No">
						      <span class="input-group-btn">
						        <button class="btn btn-custom waves-effect waves-light btn-md" id="next" type="button" onclick="submitfrm()">NEXT</button>
						      </span>
						</div>    

				    </form>   	
		        </div>
			</div>
		</div>
    </div>
    <script type="text/javascript">
    	var url="{{ '/'.getenv('APP_NAME').'/public/donors/' }}";
    	function submitfrm(){
    		var term=document.getElementById('search').value;
    		term=term.replace(/\//g, ':');


	    	url = url.concat(term);
			window.location.href =url;
    	}
    	
    </script>