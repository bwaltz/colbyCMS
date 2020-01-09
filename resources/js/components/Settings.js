import React, { Component } from "react";
import Menu from "./Menu";

import { toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import "./style.scss";

export default class Pages extends Component {
    constructor(props) {
        super(props);
        this.state = {
            settings: {},
            settingsIdMap: {},
            // activeSection: 0,
            loading: true,
            dirtySections: []
        };

        this.changeSetting = this.changeSetting.bind(this);
        this.saveSettings = this.saveSettings.bind(this);
    }

    componentDidMount() {
        this.getSettings();
    }

    getSettings() {
        axios.get("/api/settings/").then(response => {
            this.setState({
                settings: response.data.data,
                settingsIdMap: response.data.settingsIdMap,
                loading: false
            });
        });
    }

    saveSettings() {
        this.state.dirtySections.forEach(section => {
            const data = {
                key: "section",
                value: this.state.settings[section]
            };

            axios
                .put(`/api/settings/${this.state.settingsIdMap[section]}`, data)
                .then(response => {
                    this.getSettings();
                });
        });
        toast("Success!", {
            className: "green-background",
            bodyClassName: "grow-font-size",
            autoClose: 3000,
            pauseOnFocusLoss: false
        });
    }

    changeSetting(value, section, key) {
        let dirtySections = this.state.dirtySections;

        if (!dirtySections.includes(section)) {
            dirtySections.push(section);
        }
        this.setState({
            settings: {
                ...this.state.settings,
                [section]: {
                    ...this.state.settings[section],
                    [key]: value
                }
            },
            dirtySections
        });
    }

    render() {
        console.log(this.state);
        const pageId = this.props.match.params.id;
        return (
            <div className="container-fluid">
                <div className="row">
                    <Menu />
                    <main
                        role="main"
                        className="col-md-9 ml-sm-auto col-lg-10 px-4"
                        style={{ paddingTop: "75px" }}
                    >
                        <h1>Settings</h1>
                        {!this.state.loading && (
                            <div className="accordion" id="accordionExample">
                                <div className="card">
                                    <div
                                        className="card-header"
                                        id="headingOne"
                                    >
                                        <h2 className="mb-0">
                                            <button
                                                className="btn btn-link"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseOne"
                                                aria-expanded="true"
                                                aria-controls="collapseOne"
                                            >
                                                Emergency
                                            </button>
                                        </h2>
                                    </div>

                                    <div
                                        id="collapseOne"
                                        className="collapse show"
                                        aria-labelledby="headingOne"
                                        data-parent="#accordionExample"
                                    >
                                        <div className="card-body">
                                            <form>
                                                <div className="form-group form-check">
                                                    <input
                                                        type="checkbox"
                                                        className="form-check-input"
                                                        id="exampleCheck1"
                                                        checked={
                                                            this.state.settings
                                                                .emergency
                                                                .isEmergency
                                                        }
                                                        onChange={event => {
                                                            this.changeSetting(
                                                                event.target
                                                                    .checked,
                                                                "emergency",
                                                                "isEmergency"
                                                            );
                                                        }}
                                                    />
                                                    <label className="form-check-label">
                                                        Is this an emergency?
                                                    </label>
                                                </div>
                                                <div className="form-group">
                                                    <label>
                                                        Header Message
                                                    </label>
                                                    <textarea
                                                        className="form-control"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3"
                                                        value={
                                                            this.state.settings
                                                                .emergency
                                                                .emergencyHeader
                                                        }
                                                        onChange={event => {
                                                            this.changeSetting(
                                                                event.target
                                                                    .value,
                                                                "emergency",
                                                                "emergencyHeader"
                                                            );
                                                        }}
                                                    ></textarea>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div className="card">
                                    <div
                                        className="card-header"
                                        id="headingTwo"
                                    >
                                        <h2 className="mb-0">
                                            <button
                                                className="btn btn-link collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="collapseTwo"
                                            >
                                                Other Settings
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseTwo"
                                        className="collapse"
                                        aria-labelledby="headingTwo"
                                        data-parent="#accordionExample"
                                    >
                                        <div className="card-body">
                                            Anim pariatur cliche reprehenderit,
                                            enim eiusmod high life accusamus
                                            terry richardson ad squid. 3 wolf
                                            moon officia aute, non cupidatat
                                            skateboard dolor brunch. Food truck
                                            quinoa nesciunt laborum eiusmod.
                                            Brunch 3 wolf moon tempor, sunt
                                            aliqua put a bird on it squid
                                            single-origin coffee nulla assumenda
                                            shoreditch et. Nihil anim keffiyeh
                                            helvetica, craft beer labore wes
                                            anderson cred nesciunt sapiente ea
                                            proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft
                                            beer farm-to-table, raw denim
                                            aesthetic synth nesciunt you
                                            probably haven't heard of them
                                            accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )}
                        <div
                            style={{
                                textAlign: "right",
                                marginTop: "20px"
                            }}
                        >
                            <button
                                className="btn btn-primary"
                                onClick={this.saveSettings}
                            >
                                Save Settings
                            </button>
                        </div>
                    </main>
                </div>
            </div>
        );
    }
}
