## Solid Programming principles (uncle Bob)

In this project I practice solid programming principles, introduced by uncle bob

SOLID refers to :

S : single responsibility

O : opened/closed

L : liscov substitution

I : Interface Segregation

D : Dependency Inversion

#### ----------------------------------------------------------------

## Short description for each of them

### S : single responsibility principle

This principle says that a class should only have one job to do and not anymore.

It means that we should not have a multi task class where everything gets handled over there!

### O : opened/closed principle

This principle says that classes should be opened for extensions but close for modification.

For example when we want to add a functinality to our software, changig its source code is not mutual!

### L : Liscov substitution

Formulated by a woman called Barbara Liscov, states an object in a program should be replaceable with instances of their subtypes without altering the correctness of that program.

 a class when inherit from the other class should almost look after exactly her father, unless inheriting the class is the wrong desicion.

For example :

    "If it looks like a duck, quacks like a dog, but needs batteries - you probably have the wrong abstraction"

Behaviour, Behaviour, Behaviour

### I : Interface Segregation

This principle says : If a class extends an interface and it's not neccessary where class even does not use the methods of the interface, it's a mistake to use the interface for that class.

    "Many client-specific interfaces are better than one general-purpose interface. Dan Akroyd"

### D : Dependency Inversion

This is almsot related to open/closed principle and it says : top level modules should not be dependent on low level modules.

### Thanks

[Roocket Website By Hesam Mousavi helped me a lot](http://www.roocket.ir)

Thank you for visiting this repository and take my apologize if there is anything wrong and please do not hesitate to share it with me on [mdhesari99@gmail.com](mdhesari@gmail.com)