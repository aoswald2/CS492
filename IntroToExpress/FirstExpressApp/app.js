var express = require("express");
var app = express();

// "/" => "Hi there!"
app.get("/",function(req, res) {
    res.send("Hi there!");
});

// "/bye" => "Goodbye!"
app.get("/bye", function(req, res) {
    res.send("Goodbye!");
});

// "/dog" => "MEOW!"
app.get("/dog", function(req, res) {
    console.log("Someone made a request to /dog");
    res.send("MEOW!");
});

app.get("/r/:subReddit", function(req, res) {
    var subReddit = req.params.subReddit;
    res.send("WELCOME TO THE " + subReddit.toUpperCase() + " SUBREDDIT!");
});

app.get("/r/:subReddit/comments/:id/:title", function(req, res) {
    console.log(req.params);
    res.send("welcome to the comments page");
});

app.get("*", function(req, res) {
    res.send("you are a star!");
});

// tell Express to listen for requests (start server)
app.listen(process.env.PORT, process.env.IP, function() {
    console.log("Server has started!");
});