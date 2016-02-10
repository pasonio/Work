<script type="text/template" id="popplgn_menu_template">
<div id="overlay"></div>
<div id="popplgn_container">
    <% if ( close_button == 1 ) { %>
        <span id="popplgn_close">X</span>
    <% } %>
    <span id="counter"><%= timer %></span>
    <h2 id="popplgn_header"><%- title %></h2>
    <p id="popplgn_text"><%- body %></p>
</div>
</script>