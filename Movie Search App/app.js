const express = require("express");
const request = require("request");
const app = express();
app.set("view engine", "ejs");

app.get("/", function(req, res) {
    res.render("search");
});

app.get("/results", function(req, res) {
    var query = req.query.search;
    request("http://omdbapi.com/?s=" + query + "&apikey=thewdb", function(error, response, body) {
        if(!error && response.statusCode === 200) {
            const data = JSON.parse(body);
            res.render("results", {data: data});
        }
    });
});

app.listen(process.env.PORT, process.env.IP, function() {
    console.log("Movie App has started");
})