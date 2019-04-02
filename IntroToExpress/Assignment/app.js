var express = require("express");
var app = express();

app.get("/", function(req, res) {
    res.send("Hi there, welcome to my assignment!");
});

app.get("/speak/:animal", function(req, res) {
    var animal = req.params.animal.toLowerCase();
    var sounds = {
        pig: '"Oink"',
        cow: '"Moo"',
        dog: '"Woof Woof!"'
    }
    var string = "The " + animal + " says " + sounds[animal];
    res.send(string);
});

app.get("/repeat/:word/:num", function(req, res) {
    var num = parseInt(req.params.num);
    var string = "";
    for(var i = 0; i < num; i ++) {
        string += req.params.word;
        if(i < num-1) string += " ";
    }
    res.send(string);
});

app.get("*", function(req, res) {
    res.send("Sorry, page not found...What are you doing with your life?");
});

// tell Express to listen for requests (start server)
app.listen(process.env.PORT, process.env.IP, function() {
    console.log("Server has started!");
});