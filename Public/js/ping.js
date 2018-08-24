
<script type="application/ld+json">
{
"@context": "http://schema.org/",
"@type": "Code",
"name": "Ping a server in javascript",
"description": "maybe not &#39;ping exactly&#39; but seems to work",
"url": "//jsfiddle.net/9cbhw43j/",
"dateCreated": "",
"codeSampleType": [
{
"@type": "SoftwareSourceCode",
"programmingLanguage": "javascript",
"text": "function ping(ip, callback) {

if (!this.inUse) {
this.status = &#39;unchecked&#39;;
this.inUse = true;
this.callback = callback;
this.ip = ip;
var _that = this;
this.img = new Image();
this.img.onload = function () {
_that.inUse = false;
_that.callback(&#39;responded&#39;);

};
this.img.onerror = function (e) {
if (_that.inUse) {
_that.inUse = false;
_that.callback(&#39;responded&#39;, e);
}

};
this.start = new Date().getTime();
this.img.src = &quot;http://&quot; + ip;
this.timer = setTimeout(function () {
if (_that.inUse) {
_that.inUse = false;
_that.callback(&#39;timeout&#39;);
}
}, 1500);
}
}
var PingModel = function (servers) {
var self = this;
var myServers = [];
ko.utils.arrayForEach(servers, function (location) {
myServers.push({
name: location,
status: ko.observable(&#39;unchecked&#39;)
});
});
self.servers = ko.observableArray(myServers);
ko.utils.arrayForEach(self.servers(), function (s) {
s.status(&#39;checking&#39;);
new ping(s.name, function (status, e) {
s.status(status);
});
});
};
var komodel = new PingModel([&#39;localhost&#39;,
&#39;ws-bdimperio8&#39;,
&#39;ws-bdimperio8.payformance.net&#39;,
&#39;ws-bdimperio8.payformance.com&#39;,
&#39;ws-bdimperio8.payspan.com&#39;,
&#39;ws-bdimperio8/favicon.ico&#39;,
&#39;127.0.0.1&#39;,
&#39;unknown&#39;
]);
ko.applyBindings(komodel);"
},