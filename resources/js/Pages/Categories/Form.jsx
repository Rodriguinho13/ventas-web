import Modal from "@/Components/Modal";
import { useState } from "react";
import { useForm } from "@inertiajs/react";

export default function Form ({id = 0, category = {}}) {
    const [showModal, setShowModal] = useState(false);
    const {data, setData, post, put, errors, reset, clearErrors} = useForm({name: !category ? '': category.name, description: !category ? '': category.description});

    function OpenModal(){
        setShowModal(true);
    }

    function CloseModal(e){//para cerrar el modal en Cancelar
        e.preventDefault();//para que no se actualice la pagina
        setShowModal(false);
        clearErrors();
        reset();
    }

    const submitCategory = (e) =>{
        e.preventDefault();//para que no se actualice la pagina
        console.log(data);
        if(id === 0){
            //////para que la información del formulario se guarde en la BD//////
            post(route('categories.store'), {
                onSuccess: (res) => {
                console.log('OK', res);
                CloseModal();
                },
                onError: (error) => console.log('error', error)
            })
        }
        else{
            console.log('update');
            put(route('categories.update', id), {
                onSuccess: (res) => {
                console.log('OK', res);
                CloseModal();
                },
                onError: (error) => console.log('error', error)
            })
        }

    }

    return (
        <div>
            <div>
                { id === 0 ? (
                    <button onClick={OpenModal}>Crear nueva Categoria</button>
                ): (
                    <button onClick={OpenModal}>Editar Categoria</button>
                )}
            </div>
            <Modal show={showModal} closeable={true} onClose={setShowModal}>
                <h1>CREAR NUEVA CATEGORIA</h1>
                <form>
                    <label>Nombre categoria</label>
                    <input type="text" name="name" value={data.name} onChange={(e) => setData('name', e.target.value)}/>
                    {errors.name && (
                        <p>{errors.name}</p>
                    )}
                    <label>Descripcion categoria</label>
                    <input type="text" name="description" value={data.description} onChange={(e) => setData('description', e.target.value)}/>
                    <button onClick={CloseModal}>Cancelar</button>
                    <button onClick={submitCategory}>Guardar</button>
                </form>
            </Modal>
        </div>
    )
}
