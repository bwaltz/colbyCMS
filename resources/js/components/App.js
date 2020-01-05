import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import Header from "./Header";
import Home from "./Home";
import Posts from "./Posts";
import Pages from "./Pages";
import Post from "./Post";
import Page from "./Page";
import MediaLibrary from "./MediaLibrary";
import { ToastContainer, toast } from "react-toastify";

export default class App extends Component {
    render() {
        return (
            <>
                <ToastContainer />
                <BrowserRouter>
                    <Header />
                    <Switch>
                        <Route exact path="/admin/dashboard" component={Home} />
                        <Route exact path="/admin/posts" component={Posts} />
                        <Route exact path="/admin/pages" component={Pages} />
                        <Route
                            exact
                            path="/admin/media-library"
                            component={MediaLibrary}
                        />
                        <Route exact path="/admin/posts/:id" component={Post} />
                        <Route exact path="/admin/pages/:id" component={Page} />
                    </Switch>
                </BrowserRouter>
            </>
        );
    }
}

ReactDOM.render(<App />, document.getElementById("cms-admin"));
