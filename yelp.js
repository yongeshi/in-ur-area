$(document).ready(function () {
    // Executes once the page has completely loaded
  
    // Form Related
    const $searchForm = $("#submit-search");
    const $searchTerm = $("#restaurant_input");
    const $searchBy = $("input[name='search']:checked"); //correct? **************
    const $searchLatitude = $("#latitude");
    const $searchLongitude = $("#longitude");
  
    // Yelp Grid (results load here)
    const $yelpGrid = $("#yelp-grid");
  
    // Load From Yelp Function
    function loadFromYelp(searchTerm, searchBy, searchLatitude, searchLongitude) {
      $.ajax({
        method: "GET",
        url: "yelp_backend.php",
        data: { searchTerm: searchTerm, searchBy: searchBy, searchLatitude: searchLatitude, searchLongitude: searchLongitude },
      }).done(function (response) {
        // Clears $yelpGrid
        $yelpGrid.html("");
        for (let business of response) {
            const businessHTML = `
            <hr class="hr_">
            <div class="outerDiv_">
                <div class="leftDiv_" id="left-search-form3">
                    <a href=details.php?name=${encodeURIComponent(business.name)}&address1=${encodeURIComponent(business.address.address1)}`
                    + `&address2=${encodeURIComponent(business.address.city)}&address3=${encodeURIComponent(business.address.state)}`
                    + `&address4=${business.address.zip_code}&phone=${business.phone}&cuisine=${encodeURIComponent(business.cuisine)}`
                    + `&price=${business.price}&rating=${business.rating}&image=${business.image_url}&url=${business.url}>
                        <img border="0" alt="${business.name}" src="${business.image_url}">
                    </a>
                </div>
                <div class="rightDiv_" id="right-search-form3"> 
                    <h1>${business.name}</h1>
                    <h2>${business.address.address1}, ${business.address.city}, ${business.address.state} ${business.address.zip_code}</h2>
                    <h2>${business.url}</h2>
                </div>
            </div>`;
  
          // Append business to $yelpGrid
          $yelpGrid.append(businessHTML);
        }
      });
    }
  
    // Form Handler
    $searchForm.on("submit", function (e) {
      //e.preventDefault(); should this be on??????????*******************
  
      // Get input values
      const searchTerm = $searchTerm.val();
      const searchBy = $searchBy.val();
      const searchLatitude = $searchLatitude.val();
      const searchLongitude = $searchLongitude.val();
  
      loadFromYelp(searchTerm, searchBy, searchLatitude, searchLongitude);
    });
  
    // On page load   
    loadFromYelp($searchTerm.val(), $searchBy.val(), $searchLatitude.val(), $searchLongitude.val());
    //loadFromYelp("boba", "best_match", 34, -118);
  });