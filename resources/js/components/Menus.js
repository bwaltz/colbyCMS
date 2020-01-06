import React, { Component } from "react";
import Menu from "./Menu";

export default class Menus extends Component {
    constructor(props) {
        super(props);
        this.state = {
            menus: []
        };
    }

    componentDidMount() {
        // this.getMenus();
    }

    render() {
        return (
            <div className="container-fluid">
                <div className="row">
                    <Menu />
                    <main
                        role="main"
                        className="col-md-9 ml-sm-auto col-lg-10 px-4"
                        style={{ paddingTop: "75px" }}
                    >
                        <h1>Menus</h1>
                        <p>Coming soon.</p>
                    </main>
                </div>
            </div>
        );
    }
}
