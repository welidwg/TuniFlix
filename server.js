const express = require("express");
const app = express();
const server = require("http").createServer(app);
const mysql = require("mysql");
const { NULL } = require("mysql/lib/protocol/constants/types");
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "tuniflix",
});
var pool = mysql.createPool({
    connectionLimit: 10, // default = 10
    host: "localhost",
    user: "root",
    password: "",
    database: "tuniflix",
});

const io = require("socket.io")(server, {
    cors: {
        origin: "*",
    },
});
io.on("connection", (socket) => {
    console.log("socket connected");
    // ...
    socket.on("disconnect", (data) => {
        var rooms = io.sockets.adapter.rooms;

        let clientsInRoom = 0;
        if (io.sockets.adapter.rooms.has(data.room))
            clientsInRoom = io.sockets.adapter.rooms.get(data.room).size;
        console.log("a user has left the session");
        pool.getConnection(function (err, connection) {
            connection.query(
                `UPDATE session SET Users=${
                    clientsInRoom - 1
                } where SessionID='${data.room}' and Users!=0`,
                function (err, rows) {
                    console.log(rows);
                    connection.release();

                    if (err) throw err;
                }
            );
        });
    });
    socket.on("join", function (data) {
        socket.join(data.room);

        let clientsInRoom = 0;
        if (io.sockets.adapter.rooms.has(data.room))
            clientsInRoom = io.sockets.adapter.rooms.get(data.room).size;
        console.log(clientsInRoom);
        console.log("in the room: " + data.room);
        pool.getConnection(function (err, connection) {
            connection.query(
                "UPDATE session SET Users=" +
                    clientsInRoom +
                    " where SessionID='" +
                    data.room +
                    "'  ",
                function (err, rows) {
                    connection.release();
                    if (err) throw err;
                }
            );
        });
    });
    socket.on("playing", (data) => {
        let room = data.room;
        let id = data.id;
        io.to(room).emit("play", id);
    });
    socket.on("refreshing", (data) => {
        let room = data.room;
        let id = data.id;
        io.to(room).emit("refresh", id);
    });
    socket.on("pausing", (data) => {
        let room = data.room;
        let id = data.id;
        io.to(room).emit("pause", id);
    });
    socket.on("forwarding", (data) => {
        let room = data.room;
        let id = data.id;
        io.to(room).emit("forward", id);
    });
    socket.on("backwarding", (data) => {
        let room = data.room;
        let id = data.id;
        io.to(room).emit("backward", id);
    });

    socket.on("progress", (data) => {
        let time = data.time;
        let room = data.room;

        pool.getConnection(function (err, connection) {
            connection.query(
                `UPDATE session SET Progress=${time} where SessionID='${room}'`,
                function (err, rows) {
                    connection.release();
                    if (err) throw err;
                }
            );
        });
    });
});

server.listen(3000, () => {
    console.log("Server is running");
});
