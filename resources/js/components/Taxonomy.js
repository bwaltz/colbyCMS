import React, { Component } from "react";
import Menu from "./Menu";
import "./style.scss";

import Modal from "react-modal";

const ColbyCMS = window.colbyCMS;
import _findIndex from "lodash/findIndex";

import { DndProvider } from "react-dnd";
import HTML5Backend from "react-dnd-html5-backend";
import Sortly, { ContextProvider, useDrag, useDrop } from "react-sortly";

import { Motion, spring } from "react-motion";
import _remove from "lodash/remove";
import _cloneDeep from "lodash/cloneDeep";

const ItemRenderer = props => {
    const {
        data: { name, depth, id },
        index,
        removeItem
    } = props;
    const [, drag] = useDrag();
    const [, drop] = useDrop();
    return (
        <Motion
            key={name}
            style={{
                y: spring(index, { stiffness: 600, damping: 32 }),
                x: spring(index, { stiffness: 600, damping: 32 })
            }}
        >
            {({ y, x }) => (
                <div
                    ref={drop}
                    style={{
                        transform: "translate3d(" + x + "px, " + y + "px, 0)"
                    }}
                >
                    <div
                        ref={drag}
                        style={{
                            marginLeft: depth * 20,
                            zIndex: "0",
                            position: "relative",
                            marginBottom: "8px"
                        }}
                    >
                        <div
                            style={{
                                cursor: "move",
                                display: "flex",
                                boxShadow: "rgb(102, 102, 102) 0px 0px 2px",
                                borderWidth: "1px",
                                borderStyle: "solid",
                                borderColor: "transparent",
                                borderImage: "initial",
                                background: "rgb(255, 255, 255)"
                            }}
                        >
                            <button
                                className="MuiButtonBase-root MuiIconButton-root"
                                tabIndex="0"
                                type="button"
                                draggable="true"
                            >
                                <span className="MuiIconButton-label">
                                    <svg
                                        className="MuiSvgIcon-root"
                                        focusable="false"
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                        role="presentation"
                                    >
                                        <path d="M3 15h18v-2H3v2zm0 4h18v-2H3v2zm0-8h18V9H3v2zm0-6v2h18V5H3z"></path>
                                    </svg>
                                </span>
                                <span className="MuiTouchRipple-root"></span>
                            </button>
                            <div className="MuiBox-root jss174">
                                <div className="MuiInputBase-root MuiInputBase-fullWidth">
                                    {name}
                                </div>
                            </div>
                            {_findIndex(
                                ColbyCMS.currentUser.permissions,
                                o => o.name === "admin.delete.taxonomy.term"
                            ) >= 0 && (
                                <button
                                    className="MuiButtonBase-root MuiIconButton-root"
                                    tabIndex="0"
                                    type="button"
                                    onClick={removeItem.bind(null, id)}
                                >
                                    <span className="MuiIconButton-label">
                                        <svg
                                            className="MuiSvgIcon-root"
                                            focusable="false"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                            role="presentation"
                                        >
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                                        </svg>
                                    </span>
                                    <span className="MuiTouchRipple-root"></span>
                                </button>
                            )}
                        </div>
                    </div>
                </div>
            )}
        </Motion>
    );
};

const MySortableTree = props => {
    const [items, setItems] = React.useState([
        { id: 1, name: "Academics", depth: 0 },
        { id: 3, name: "English", depth: 1 },
        { id: 8, name: "Biology", depth: 1 },
        { id: 4, name: "Computer Science", depth: 1 },
        { id: 7, name: "AI", depth: 2 },
        { id: 2, name: "Athletics", depth: 0 },
        { id: 5, name: "Swimming", depth: 1 },
        { id: 6, name: "Golf", depth: 1 }
    ]);
    const [modalIsOpen, setmodalIsOpen] = React.useState(false);
    const [newTerm, changeNewTerm] = React.useState({
        name: "",
        parent: 1
    });

    const handleChange = newItems => {
        setItems(newItems);
    };

    const openModal = () => {
        setmodalIsOpen(true);
    };

    const closeModal = () => {
        setmodalIsOpen(false);
    };

    const addNewTerm = () => {
        const index = items.findIndex(item => item.id === newTerm.parent);
        console.log(index);
        items.splice(
            index + 1,
            0,
            Object.assign({ depth: items[index].depth + 1 }, newTerm)
        );

        closeModal();
    };

    const removeTerm = id => {
        let newItems = _cloneDeep(items);
        _remove(newItems, item => item.id === id);
        setItems(newItems);
        closeModal();
    };

    const onNewTermChange = obj => {
        changeNewTerm(obj);
    };

    const customStyles = {
        content: {
            top: "50%",
            left: "50%",
            right: "auto",
            bottom: "auto",
            marginRight: "-50%",
            transform: "translate(-50%, -50%)"
        }
    };

    console.log(newTerm);
    return (
        <>
            {_findIndex(
                ColbyCMS.currentUser.permissions,
                o => o.name === "admin.add.taxonomy.term"
            ) >= 0 && (
                <div
                    style={{
                        textAlign: "right",
                        marginBottom: "20px"
                    }}
                >
                    <button className="btn btn-primary" onClick={openModal}>
                        Add Term
                    </button>
                </div>
            )}
            <Sortly items={items} onChange={handleChange}>
                {props => <ItemRenderer removeItem={removeTerm} {...props} />}
            </Sortly>
            <Modal
                isOpen={modalIsOpen}
                onRequestClose={closeModal}
                style={customStyles}
                contentLabel="Example Modal"
                className="post-modal"
                overlayClassName="post-modal-overlay"
            >
                <h2>New Term</h2>

                <div className="form-group">
                    <label>Name</label>
                    <input
                        className="form-control"
                        onChange={event =>
                            onNewTermChange({
                                ...newTerm,
                                name: event.target.value
                            })
                        }
                    />
                </div>
                <div className="form-group">
                    <label>Parent Term</label>
                    <select
                        className="form-control"
                        onChange={event =>
                            onNewTermChange({
                                ...newTerm,
                                parent: +event.target.value
                            })
                        }
                    >
                        <option value="1">Academics</option>
                        <option value="8">Biology</option>
                        <option value="2">Athletics</option>
                    </select>
                </div>

                <button
                    type="submit"
                    className="btn btn-primary"
                    onClick={addNewTerm}
                >
                    Submit
                </button>
            </Modal>
        </>
    );
};

export default class Taxonomy extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    handleChange(newItems) {
        this.setState({
            items: newItems
        });
    }

    componentDidMount() {
        // this.getPosts();
    }

    render() {
        console.log(this.state);

        return (
            <div className="container-fluid">
                <div className="row">
                    <Menu />
                    <main
                        role="main"
                        className="col-md-9 ml-sm-auto col-lg-10 px-4"
                        style={{ paddingTop: "75px" }}
                    >
                        <h1>Taxonomy</h1>
                        <div style={{ marginTop: "5px" }}>
                            <DndProvider backend={HTML5Backend}>
                                <ContextProvider>
                                    <MySortableTree />
                                </ContextProvider>
                            </DndProvider>
                        </div>
                    </main>
                </div>
            </div>
        );
    }
}
